<?php

namespace App\Http\Controllers\Action;

use App\Http\Controllers\Controller;
use App\Models\DivingApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Mail\ApplicationCompletedMail;
use Illuminate\Support\Facades\Mail;

class DivingApplicationController extends Controller
{
    public function handleAction(Request $request, $id, $action)
    {
        try {
            $application = DivingApplication::findOrFail($id);

            switch ($action) {
                case 'approve':
                    $request->validate([
                        'schedule_date' => 'required|date',
                        'schedule_time' => 'required|date_format:H:i',
                    ]);

                    if ($application->status !== 'Pending') {
                        return $this->failed(null, 'Only pending applications can be approved', 400);
                    }

                    $application->schedule_date = $request->schedule_date;
                    $application->schedule_time = $request->schedule_time;
                    $application->status = 'Approved';
                    break;

                case 'cancel':
                    if ($application->status !== 'Pending') {
                        return $this->failed(null, 'Only pending applications can be cancelled', 400);
                    }

                    $application->delete();
                    return $this->success(null, 'Application cancelled (deleted) successfully.');
                    break;

                case 'reject':
                    if ($application->status !== 'Pending') {
                        return $this->failed(null, 'Only pending applications can be rejected', 400);
                    }

                    $application->status = 'Rejected';
                    break;

                case 'setOngoing':
                    if ($application->status !== 'Approved') {
                        return $this->failed(null, 'Only approved applications can be marked as Ongoing', 400);
                    }

                    $application->status = 'Ongoing';
                    break;

                case 'setCompleted':
                    if ($application->status !== 'Ongoing') {
                        return $this->failed(null, 'Only ongoing applications can be marked as Completed', 400);
                    }

                    $application->status = 'Completed';

                    // Send email notification
                    Mail::to($application->user->email)->send(new ApplicationCompletedMail($application));

                    break;

                default:
                    return $this->failed(null, 'Invalid action', 400);
            }

            $application->save();
            return $this->success($application, "Application {$action}d successfully.");
        } catch (\Exception $e) {
            Log::error("Failed to {$action} application ID {$id}: " . $e->getMessage());
            return $this->failed(null, "Failed to {$action} application", 500);
        }
    }


    // Approve the application
    public function approve(Request $request, $id)
    {
        $request->validate([
            'schedule_date' => 'required|date',
            'schedule_time' => 'required|date_format:H:i',
        ]);

        try {
            $application = DivingApplication::findOrFail($id);

            if ($application->status !== 'Pending') {
                return $this->failed(null, 'Only pending applications can be approved', 400);
            }

            $application->schedule_date = $request->schedule_date;
            $application->schedule_time = $request->schedule_time;
            $application->status = 'Approved';
            $application->save();

            return $this->success($application, 'Application approved successfully.');
        } catch (\Exception $e) {
            Log::error("Failed to approve application ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to approve application', 500);
        }
    }

    // Set the application as Ongoing
    public function setOngoing($id)
    {
        try {
            $application = DivingApplication::findOrFail($id);

            if ($application->status !== 'Approved') {
                return $this->failed(null, 'Only approved applications can be marked as Ongoing', 400);
            }

            $application->status = 'Ongoing';
            $application->save();

            return $this->success($application, 'Application marked as Ongoing.');
        } catch (\Exception $e) {
            Log::error("Failed to set application ID {$id} as Ongoing: " . $e->getMessage());
            return $this->failed(null, 'Failed to mark application as Ongoing', 500);
        }
    }

    // Set the application as Completed
    public function setCompleted($id)
    {
        try {
            $application = DivingApplication::with(['user', 'lesson'])->findOrFail($id);

            if ($application->status !== 'Ongoing') {
                return $this->failed(null, 'Only ongoing applications can be marked as Completed', 400);
            }

            $application->status = 'Completed';
            $application->save();

            // Send email notification
            Mail::to($application->user->email)->send(new ApplicationCompletedMail($application));

            return $this->success($application, 'Application marked as Completed and email sent.');
        } catch (\Exception $e) {
            \Log::error("Failed to set application ID {$id} as Completed: " . $e->getMessage());
            return $this->failed(null, 'Failed to mark application as Completed', 500);
        }
    }

    // Reject the application
    public function reject($id)
    {
        try {
            $application = DivingApplication::findOrFail($id);

            if ($application->status !== 'Pending') {
                return $this->failed(null, 'Only pending applications can be rejected', 400);
            }

            $application->status = 'Rejected';
            $application->save();

            return $this->success($application, 'Application rejected successfully.');
        } catch (\Exception $e) {
            Log::error("Failed to reject application ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to reject application', 500);
        }
    }

    // Reject the application
    public function cancel($id)
    {
        try {
            $application = DivingApplication::findOrFail($id);

            if ($application->status !== 'Pending') {
                return $this->failed(null, 'Only pending applications can be cancelled', 400);
            }

            $application->status = 'Cancelled';
            $application->save();

            return $this->success($application, 'Application rejected successfully.');
        } catch (\Exception $e) {
            Log::error("Failed to reject application ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to reject application', 500);
        }
    }
}
