<?php

namespace App\Http\Controllers;

use App\Models\Vessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VesselController extends Controller
{
    public function index()
    {
        try {
            $vessels = Vessel::all();
            return $this->success($vessels, 'Vessels retrieved successfully');
        } catch (\Exception $e) {
            Log::error('Failed to fetch vessels: ' . $e->getMessage());
            return $this->failed(null, 'Failed to fetch vessels', 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vessel_name'      => 'required|string|max:100|unique:vessels',
            'vessel_owner'     => 'required|string|max:100',
            'vessel_location'  => 'required|string|max:30',
            'imo_on'           => 'required|string|max:15|unique:vessels',
            'home_port'        => 'required|string|max:30',
            'place_of_built'   => 'required|string|max:30',
            'type_of_service'  => 'required|string|max:30',
            'length'           => 'required|string|max:30',
            'no_screws'        => 'required|string|max:15',
            'breadth'          => 'required|string|max:20',
            'material'         => 'required|string|max:30',
            'depth'            => 'required|string|max:30',
            'gross_tonnage'    => 'required|string|max:30',
            'engine'           => 'required|string|max:30',
            'net_tonnage'      => 'required|string|max:30',
            'year_built'       => 'required|date',
            'launch_date'      => 'required|date',
            'horse_power'      => 'required|string|max:30',
            'user_id'          => 'required|exists:users,id',
        ]);

        try {
            $vessel = Vessel::create($validated);
            return $this->success($vessel, 'Vessel created successfully', 201);
        } catch (\Exception $e) {
            Log::error('Failed to create vessel: ' . $e->getMessage());
            return $this->failed(null, 'Failed to create vessel', 500);
        }
    }

    public function show($id)
    {
        try {
            $vessel = Vessel::findOrFail($id);
            return $this->success($vessel, 'Vessel retrieved successfully');
        } catch (\Exception $e) {
            Log::error("Failed to retrieve vessel ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Vessel not found', 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $vessel = Vessel::findOrFail($id);

            $validated = $request->validate([
                'vessel_name'      => 'sometimes|required|string|max:100|unique:vessels,vessel_name,' . $id,
                'vessel_owner'     => 'sometimes|required|string|max:100',
                'vessel_location'  => 'sometimes|required|string|max:30',
                'imo_on'           => 'sometimes|required|string|max:15|unique:vessels,imo_on,' . $id,
                'home_port'        => 'sometimes|required|string|max:30',
                'place_of_built'   => 'sometimes|required|string|max:30',
                'type_of_service'  => 'sometimes|required|string|max:30',
                'length'           => 'sometimes|required|string|max:30',
                'no_screws'        => 'sometimes|required|string|max:15',
                'breadth'          => 'sometimes|required|string|max:20',
                'material'         => 'sometimes|required|string|max:30',
                'depth'            => 'sometimes|required|string|max:30',
                'gross_tonnage'    => 'sometimes|required|string|max:30',
                'engine'           => 'sometimes|required|string|max:30',
                'net_tonnage'      => 'sometimes|required|string|max:30',
                'year_built'       => 'sometimes|required|date',
                'launch_date'      => 'sometimes|required|date',
                'horse_power'      => 'sometimes|required|string|max:30',
                'user_id'          => 'sometimes|required|exists:users,id',
            ]);

            $vessel->update($validated);
            return $this->success($vessel, 'Vessel updated successfully');
        } catch (\Exception $e) {
            Log::error("Failed to update vessel ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to update vessel', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $vessel = Vessel::findOrFail($id);
            $vessel->delete();
            return $this->success(null, 'Vessel deleted successfully');
        } catch (\Exception $e) {
            Log::error("Failed to delete vessel ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to delete vessel', 500);
        }
    }
}
