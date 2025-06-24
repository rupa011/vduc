<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\DivingApplication;
use App\Models\DiversLog;
use App\Models\DivingLesson;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DivingReportController extends Controller
{
    public function index(Request $request)
{
    $query = DivingApplication::with('user', 'lesson');

    if ($request->filled('user_id')) {
        $query->where('user_id', $request->user_id);
    }
    if ($request->filled('from') && $request->filled('to')) {
        $query->whereBetween('created_at', [$request->from, $request->to]);
    }

    $applications = $query->get();
    $logs = DiversLog::with('application.user')->get();
    $lessons = DivingLesson::withCount('applications')->get();
    $users = User::where('role', 'Student')->get(); // 👈 Add this

    return view('reports.diving', compact('applications', 'logs', 'lessons', 'users'));
}


  public function exportPdf(Request $request)
{
    $query = DivingApplication::with('user', 'lesson');

    if ($request->filled('user_id')) {
        $query->where('user_id', $request->user_id);
    }
    if ($request->filled('from') && $request->filled('to')) {
        $query->whereBetween('created_at', [$request->from, $request->to]);
    }

    $applications = $query->get();
    $logs = DiversLog::with('application.user')->get();
    $lessons = DivingLesson::withCount('applications')->get();
    $users = User::where('role', 'Student')->get(); // 👈 Needed for PDF blade if user filter dropdown is there

    $pdf = PDF::loadView('reports.diving', compact('applications', 'logs', 'lessons', 'users'));
    return $pdf->download('diving_report.pdf');
}

}
