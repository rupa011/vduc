<?php

namespace App\Http\Controllers\Action;

use App\Http\Controllers\Controller;
use App\Models\DiversLog;
use App\Models\DivingApplication;

class StudentController extends Controller
{
    public function getApplications($studentId)
    {
        $applications = \App\Models\DivingApplication::with('lesson') // <- Eager load the lesson
            ->where('user_id', $studentId)
            ->whereIn('status', ['Approved', 'Ongoing', 'Completed'])
            ->get();

        return response()->json($applications);
    }

    public function getDiversLogs($applicationId)
    {
        $logs = DiversLog::where('application_id', $applicationId)->get();
        return response()->json($logs);
    }

    public function viewDiversLog($applicationId)
    {
        $diversLogs = DiversLog::where('application_id', $applicationId)->get();
        return view('employee.diving.divers_logs_partial', compact('diversLogs'));
    }
}
