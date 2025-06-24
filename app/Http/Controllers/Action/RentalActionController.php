<?php

namespace App\Http\Controllers\Action;

use App\Http\Controllers\Controller;
use App\Models\EquipmentRentalItem;
use App\Models\Rental;
use App\Models\RentalItemStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class RentalActionController extends Controller
{
    public function handle(Request $request, $rentalId)
    {
        try {
            $request->validate([
                'action' => 'required|in:confirm,cancel,release,return',
            ]);

            $rental = Rental::with('equipmentItems')->findOrFail($rentalId);

            DB::transaction(function () use ($rental, $request) {
                match ($request->action) {
                    'cancel' => $this->cancel($rental),
                    'release' => $this->release($rental),
                    'return' => $this->return($rental),
                };
            });

            return $this->success(null, ucfirst($request->action) . ' action successful.');
        } catch (\Exception $e) {
            Log::error('Failed to handle rental action: ' . $e->getMessage());
            return $this->failed(null, 'Failed to handle rental action', 500);
        }
    }

    private function cancel(Rental $rental)
    {
        if (!in_array($rental->status, ['Pending', 'Confirmed'])) {
            abort(400, 'Only pending or confirmed rentals can be cancelled.');
        }

        $rental->update(['status' => 'Cancelled']);
    }

    private function release(Rental $rental)
    {
        if ($rental->status !== 'Confirmed') {
            abort(400, 'Only confirmed rentals can be released.');
        }

        $rental->update(['status' => 'Released']);
    }

    private function return(Rental $rental)
    {
        if (!in_array($rental->status, ['Released', 'Overdue'])) {
            abort(400, 'Only released or overdue rentals can be returned.');
        }

        $rentalItemStatuses = RentalItemStatus::where('rental_id', $rental->id)->get();

        if ($rentalItemStatuses->isEmpty()) {
            abort(400, 'Cannot return rental. No item statuses recorded.');
        }

        foreach ($rental->equipmentRentalItems as $item) {
            $totalStatusQuantity = $rentalItemStatuses
                ->where('equipment_id', $item->equipment_id)
                ->sum('quantity');

            if ($totalStatusQuantity !== $item->quantity) {
                abort(400, 'Mismatch in returned item quantities.');
            }
        }

        $rental->update(['status' => 'Returned']);
    }

    public function rentalItems(Rental $rental)
    {
        $items = EquipmentRentalItem::with('equipment')
            ->where('rental_id', $rental->id)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'equipment_id' => $item->equipment_id,
                    'equipment_name' => $item->equipment->equipment_name,
                    'quantity' => $item->quantity,
                ];
            });

        return response()->json(['items' => $items]);
    }

    public function confirmRental(Request $request)
    {
        try {
            $validated = $request->validate([
                'rental_id' => 'required|exists:rentals,id',
                'items' => 'required|array',
                'items.*.equipment_id' => 'required|exists:equipment,id',
                'items.*.quantity' => 'required|integer|min:1',
            ]);

            $rental = Rental::findOrFail($validated['rental_id']);

            foreach ($validated['items'] as $itemId => $item) {
                EquipmentRentalItem::where('id', $itemId)
                    ->where('rental_id', $rental->id)
                    ->update(['quantity' => $item['quantity']]);
            }

            $rental->update(['status' => 'Confirmed']);

            return $this->success(null, 'Rental confirmed with updated quantities.');
        } catch (\Exception $e) {
            Log::error('Failed to confirm rental: ' . $e->getMessage());
            return $this->failed(null, 'Failed to confirm rental', 500);
        }
    }

    public function submitReturn(Request $request, Rental $rental)
    {
        try {
            $validated = $request->validate([
                'statuses' => 'required|array',
                'statuses.*.equipment_id' => 'required|integer|exists:equipment,id',
                'statuses.*.okay' => 'nullable|integer|min:0',
                'statuses.*.damaged' => 'nullable|integer|min:0',
                'statuses.*.lost' => 'nullable|integer|min:0',
            ]);

            foreach ($validated['statuses'] as $itemId => $status) {
                $total = ($status['okay'] ?? 0) + ($status['damaged'] ?? 0) + ($status['lost'] ?? 0);
                $rentedItem = EquipmentRentalItem::findOrFail($itemId);

                if ($total === 0) {
                    throw ValidationException::withMessages([
                        "statuses.$itemId" => "Please enter at least one quantity (okay, damaged, or lost) for equipment ID {$rentedItem->equipment_id}.",
                    ]);
                }

                if ($total > $rentedItem->quantity) {
                    throw ValidationException::withMessages([
                        "statuses.$itemId" => "Total quantity returned for equipment ID {$rentedItem->equipment_id} exceeds the rented quantity.",
                    ]);
                }
            }

            DB::transaction(function () use ($validated, $rental) {
                foreach ($validated['statuses'] as $status) {
                    $equipmentId = $status['equipment_id'];

                    if (!empty($status['okay']) && $status['okay'] > 0) {
                        RentalItemStatus::create([
                            'rental_id' => $rental->id,
                            'equipment_id' => $equipmentId,
                            'status' => 'Okay',
                            'quantity' => $status['okay'],
                        ]);
                    }

                    if (!empty($status['damaged']) && $status['damaged'] > 0) {
                        RentalItemStatus::create([
                            'rental_id' => $rental->id,
                            'equipment_id' => $equipmentId,
                            'status' => 'Damaged',
                            'quantity' => $status['damaged'],
                        ]);
                    }

                    if (!empty($status['lost']) && $status['lost'] > 0) {
                        RentalItemStatus::create([
                            'rental_id' => $rental->id,
                            'equipment_id' => $equipmentId,
                            'status' => 'Lost',
                            'quantity' => $status['lost'],
                        ]);
                    }
                }

                $rental->update(['status' => 'Returned']);
            });

            return $this->success(null, 'Rental returned successfully.');
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Failed to submit rental return: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit rental return',
            ], 500);
        }
    }
}
