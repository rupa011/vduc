<?php

namespace App\Http\Controllers;

use App\Models\VesselService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VesselServiceController extends Controller
{
    public function index()
    {
        try {
            $vesselServices = VesselService::all();
            return $this->success($vesselServices, 'Vessel services retrieved successfully');
        } catch (\Exception $e) {
            Log::error('Failed to fetch vessel services: ' . $e->getMessage());
            return $this->failed(null, 'Failed to fetch vessel services', 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_name'   => 'required|string|max:100',
            'description'    => 'required|string|max:255',
            'service_charge' => 'required|numeric|min:0',
        ]);

        try {
            $vesselService = VesselService::create($validated);
            return $this->success($vesselService, 'Vessel service created successfully', 201);
        } catch (\Exception $e) {
            Log::error('Failed to create vessel service: ' . $e->getMessage());
            return $this->failed(null, 'Failed to create vessel service', 500);
        }
    }

    public function show($id)
    {
        try {
            $vesselService = VesselService::findOrFail($id);
            return $this->success($vesselService, 'Vessel service retrieved successfully');
        } catch (\Exception $e) {
            Log::error("Failed to retrieve vessel service ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Vessel service not found', 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $vesselService = VesselService::findOrFail($id);

            $validated = $request->validate([
                'service_name'   => 'sometimes|required|string|max:100',
                'description'    => 'sometimes|required|string|max:255',
                'service_charge' => 'sometimes|required|numeric|min:0',
            ]);

            $vesselService->update($validated);
            return $this->success($vesselService, 'Vessel service updated successfully');
        } catch (\Exception $e) {
            Log::error("Failed to update vessel service ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to update vessel service', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $vesselService = VesselService::findOrFail($id);
            $vesselService->delete();
            return $this->success(null, 'Vessel service deleted successfully');
        } catch (\Exception $e) {
            Log::error("Failed to delete vessel service ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to delete vessel service', 500);
        }
    }
}
