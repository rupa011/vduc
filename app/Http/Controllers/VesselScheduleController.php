<?php

namespace App\Http\Controllers;

use App\Models\VesselSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VesselScheduleController extends Controller
{
    public function index()
    {
        try {
            $vesselSchedules = VesselSchedule::all();
            return $this->success($vesselSchedules, 'Vessel schedules retrieved successfully');
        } catch (\Exception $e) {
            Log::error('Failed to fetch vessel schedules: ' . $e->getMessage());
            return $this->failed(null, 'Failed to fetch vessel schedules', 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id'    => 'required|exists:vessel_services,id',
            'vessel_id'     => 'required|exists:vessels,id',
            'schedule_date' => 'required|date',
        ]);

        try {
            $vesselSchedule = VesselSchedule::create($validated);
            return $this->success($vesselSchedule, 'Vessel schedule created successfully', 201);
        } catch (\Exception $e) {
            Log::error('Failed to create vessel schedule: ' . $e->getMessage());
            return $this->failed(null, 'Failed to create vessel schedule', 500);
        }
    }

    public function show($id)
    {
        try {
            $vesselSchedule = VesselSchedule::findOrFail($id);
            return $this->success($vesselSchedule, 'Vessel schedule retrieved successfully');
        } catch (\Exception $e) {
            Log::error("Failed to retrieve vessel schedule ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Vessel schedule not found', 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $vesselSchedule = VesselSchedule::findOrFail($id);

            $validated = $request->validate([
                'service_id'    => 'sometimes|required|exists:vessel_services,id',
                'vessel_id'     => 'sometimes|required|exists:vessels,id',
                'schedule_date' => 'sometimes|required|date',
            ]);

            $vesselSchedule->update($validated);
            return $this->success($vesselSchedule, 'Vessel schedule updated successfully');
        } catch (\Exception $e) {
            Log::error("Failed to update vessel schedule ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to update vessel schedule', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $vesselSchedule = VesselSchedule::findOrFail($id);
            $vesselSchedule->delete();
            return $this->success(null, 'Vessel schedule deleted successfully');
        } catch (\Exception $e) {
            Log::error("Failed to delete vessel schedule ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to delete vessel schedule', 500);
        }
    }
}
