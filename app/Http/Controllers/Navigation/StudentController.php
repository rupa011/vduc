<?php

namespace App\Http\Controllers\Navigation;

use App\Http\Controllers\Controller;
use App\Models\DivingApplication;
use App\Models\DivingLesson;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function dashboard()
    {
        // Logic for student dashboard
        return view('student.dashboard');
    }

    public function divingLesson()
    {
        $divingLessons = DivingLesson::all();
        return view('student.lesson', compact('divingLessons'));
    }

    public function divingApplications()
    {
        $divingApplications = DivingApplication::with(['user', 'lesson'])
            ->where('user_id', auth()->id())
            ->orderByRaw("FIELD(status, 'Pending', 'Approved', 'Ongoing', 'Completed', 'Rejected')")
            ->orderBy('created_at', 'desc')
            ->get();

        $lessons = DivingLesson::all();

        return view('student.applications', compact('divingApplications', 'lessons'));
    }

    public function employeeDiversLogs()
    {
        $divingApplications = DivingApplication::with(['logs', 'lesson'])
            ->where('user_id', auth()->id())
            ->where('status', 'Completed')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.divers-logs', compact('divingApplications'));
    }
}
