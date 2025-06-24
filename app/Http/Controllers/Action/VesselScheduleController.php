<?php

namespace App\Http\Controllers\Action;

use App\Http\Controllers\Controller;
use App\Models\VesselInspection;
use Illuminate\Http\Request;
use App\Models\VesselSchedule;
use Illuminate\Support\Facades\Log;

class VesselScheduleController extends Controller
{
    public function handleAction($id, $action)
    {
        try {
            $schedule = VesselSchedule::findOrFail($id);

            if ($schedule->status === ucfirst($action)) {
                return $this->failed(null, "Schedule is already {$action}.");
            }

            if (!in_array($action, ['approved', 'declined', 'completed'])) {
                return $this->failed(null, 'Invalid action.', 400);
            }

            if ($schedule->status === 'Pending') {
                VesselInspection::create([
                    'vessel_id' => $schedule->vessel_id,
                    'schedule_id' => $schedule->id,
                ]);
            }

            $schedule->status = ucfirst($action);
            $schedule->updated_at = now(); // Trigger the updated_at timestamp
            $schedule->save();

            return $this->success($schedule, "Schedule {$action}d successfully.");
        } catch (\Exception $e) {
            Log::error("Failed to {$action} schedule ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Schedule not found', 404);
        }
    }
}
