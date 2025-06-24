<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RentalController extends Controller
{
    public function index()
    {
        try {
            $rentals = Rental::with('equipmentRentalItems')->get();
            return $this->success($rentals, 'Rentals retrieved successfully');
        } catch (\Exception $e) {
            Log::error('Failed to fetch rentals: ' . $e->getMessage());
            return $this->failed(null, 'Failed to fetch rentals', 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'       => 'required|exists:users,id',
            'pick_up_date'  => 'required|date',
            'return_date'   => 'required|date|after_or_equal:pick_up_date',
            'remarks'       => 'nullable|string',
            'equipment'     => 'required|array|min:1',
            'equipment.*.equipment_id' => 'required|exists:equipment,id',
            'equipment.*.quantity'     => 'required|integer|min:1',
        ]);

        try {
            // Create the Rental
            $rental = Rental::create([
                'user_id'      => $validated['user_id'],
                'pick_up_date' => $validated['pick_up_date'],
                'return_date'  => $validated['return_date'],
                'penalty'      => 0, // Default penalty 0
                'status'       => 'Pending', // Assuming new rentals start as Pending
                'remarks'      => $validated['remarks'] ?? null,
            ]);

            // Attach Equipment
            foreach ($validated['equipment'] as $item) {
                $rental->equipmentItems()->create([
                    'equipment_id' => $item['equipment_id'],
                    'quantity'     => $item['quantity'],
                ]);

                // Optional: Decrease available stock immediately
                Equipment::where('id', $item['equipment_id'])->decrement('quantity', $item['quantity']);
            }

            return $this->success($rental->load('equipmentItems'), 'Rental created successfully', 201);
        } catch (\Exception $e) {
            Log::error('Failed to create rental: ' . $e->getMessage());
            return $this->failed(null, 'Failed to create rental', 500);
        }
    }

    public function show($id)
    {
        try {
            $rental = Rental::with('equipmentRentalItems')->findOrFail($id);
            return $this->success($rental, 'Rental retrieved successfully');
        } catch (\Exception $e) {
            Log::error("Failed to retrieve rental ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Rental not found', 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $rental = Rental::findOrFail($id);

            $validated = $request->validate([
                'pick_up_date'  => 'sometimes|required|date',
                'return_date'   => 'sometimes|required|date|after_or_equal:pick_up_date',
                'penalty'       => 'nullable|numeric|min:0',
                'status'        => 'sometimes|required|in:Pending,Confirmed,Released,Returned,Cancelled',
                'remarks'       => 'nullable|string',
                'equipment'     => 'nullable|array',
                'equipment.*.equipment_id' => 'required_with:equipment|exists:equipment,id',
                'equipment.*.quantity'     => 'required_with:equipment|integer|min:1',
            ]);

            $rental->update($validated);

            // Update equipment rental items if provided
            if (isset($validated['equipment'])) {
                $rental->equipmentRentalItems()->delete();
                foreach ($validated['equipment'] as $item) {
                    $rental->equipmentRentalItems()->create($item);
                }
            }

            return $this->success($rental->load('equipmentRentalItems'), 'Rental updated successfully');
        } catch (\Exception $e) {
            Log::error("Failed to update rental ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to update rental', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $rental = Rental::findOrFail($id);
            $rental->equipmentRentalItems()->delete();
            $rental->delete();
            return $this->success(null, 'Rental deleted successfully');
        } catch (\Exception $e) {
            Log::error("Failed to delete rental ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to delete rental', 500);
        }
    }
}
