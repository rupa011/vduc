<?php

namespace App\Http\Controllers;

use App\Models\DiversLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DiversLogController extends Controller
{
    public function index()
    {
        try {
            $diverLogs = DiversLog::all();
            return $this->success($diverLogs, 'Diver logs retrieved successfully');
        } catch (\Exception $e) {
            Log::error('Failed to fetch diver logs: ' . $e->getMessage());
            return $this->failed(null, 'Failed to fetch diver logs', 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:diving_applications,id',
            'dive_no'        => 'required|integer',
            'location'       => 'required|string|max:100',
            'depth'          => 'required|numeric',
            'bottom_time'    => 'required|integer',
            'mins_stop'      => 'nullable|integer',
            'time_in'        => 'required|date',
            'time_out'       => 'required|date',
            'tank_start'     => 'required|integer',
            'tank_end'       => 'required|integer',
            'visibility'     => 'nullable|integer',
            'current'        => 'nullable|integer',
            'weight'         => 'nullable|numeric',
            'temperature'    => 'required|numeric',
            'date'           => 'required|date',
        ]);

        try {
            $diverLog = DiversLog::create($validated);
            return $this->success($diverLog, 'Diver log created successfully', 201);
        } catch (\Exception $e) {
            Log::error('Failed to create diver log: ' . $e->getMessage());
            return $this->failed(null, 'Failed to create diver log', 500);
        }
    }

    public function show($id)
    {
        try {
            $diverLog = DiversLog::findOrFail($id);
            return $this->success($diverLog, 'Diver log retrieved successfully');
        } catch (\Exception $e) {
            Log::error("Failed to retrieve diver log ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Diver log not found', 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $diverLog = DiversLog::findOrFail($id);

            $validated = $request->validate([
                'application_id' => 'sometimes|required|exists:diving_applications,id',
                'dive_no'        => 'sometimes|required|integer',
                'location'       => 'sometimes|required|string|max:100',
                'depth'          => 'sometimes|required|numeric',
                'bottom_time'    => 'sometimes|required|integer',
                'mins_stop'      => 'nullable|integer',
                'time_in'        => 'sometimes|required|date',
                'time_out'       => 'sometimes|required|date',
                'tank_start'     => 'sometimes|required|integer',
                'tank_end'       => 'sometimes|required|integer',
                'visibility'     => 'nullable|integer',
                'current'        => 'nullable|integer',
                'weight'         => 'nullable|numeric',
                'temperature'    => 'sometimes|required|numeric',
                'date'           => 'sometimes|required|date',
            ]);

            $diverLog->update($validated);
            return $this->success($diverLog, 'Diver log updated successfully');
        } catch (\Exception $e) {
            Log::error("Failed to update diver log ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to update diver log', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $diverLog = DiversLog::findOrFail($id);
            $diverLog->delete();
            return $this->success(null, 'Diver log deleted successfully');
        } catch (\Exception $e) {
            Log::error("Failed to delete diver log ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to delete diver log', 500);
        }
    }
}
