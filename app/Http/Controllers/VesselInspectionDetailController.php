<?php

namespace App\Http\Controllers;

use App\Models\VesselInspectionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VesselInspectionDetailController extends Controller
{
    public function index()
    {
        try {
            $details = VesselInspectionDetail::all();
            return $this->success($details, 'Vessel inspection details retrieved successfully');
        } catch (\Exception $e) {
            Log::error('Failed to fetch vessel inspection details: ' . $e->getMessage());
            return $this->failed(null, 'Failed to fetch vessel inspection details', 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vessel_inspection_id' => 'required|exists:vessel_inspections,id',
            'title'                => 'required|string|max:50',
            'description'          => 'required|string',
            'remarks'              => 'nullable|string',
            'marine_growth'        => 'nullable|string',
            'corrosion'            => 'nullable|string',
            'paint_coating'        => 'nullable|string',
        ]);

        try {
            $detail = VesselInspectionDetail::create($validated);
            return $this->success($detail, 'Vessel inspection detail created successfully', 201);
        } catch (\Exception $e) {
            Log::error('Failed to create vessel inspection detail: ' . $e->getMessage());
            return $this->failed(null, 'Failed to create vessel inspection detail', 500);
        }
    }

    public function show($id)
    {
        try {
            $detail = VesselInspectionDetail::findOrFail($id);
            return $this->success($detail, 'Vessel inspection detail retrieved successfully');
        } catch (\Exception $e) {
            Log::error("Failed to retrieve vessel inspection detail ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Vessel inspection detail not found', 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $detail = VesselInspectionDetail::findOrFail($id);

            $validated = $request->validate([
                'vessel_inspection_id' => 'sometimes|required|exists:vessel_inspections,id',
                'title'                => 'sometimes|required|string|max:50',
                'description'          => 'sometimes|required|string',
                'remarks'              => 'nullable|string',
                'marine_growth'        => 'nullable|string',
                'corrosion'            => 'nullable|string',
                'paint_coating'        => 'nullable|string',
            ]);

            $detail->update($validated);
            return $this->success($detail, 'Vessel inspection detail updated successfully');
        } catch (\Exception $e) {
            Log::error("Failed to update vessel inspection detail ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to update vessel inspection detail', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $detail = VesselInspectionDetail::findOrFail($id);
            $detail->delete();
            return $this->success(null, 'Vessel inspection detail deleted successfully');
        } catch (\Exception $e) {
            Log::error("Failed to delete vessel inspection detail ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to delete vessel inspection detail', 500);
        }
    }
}
