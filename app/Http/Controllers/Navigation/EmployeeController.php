<?php

namespace App\Http\Controllers\Navigation;

use App\Http\Controllers\Controller;
use App\Mail\VesselInspectionReportMail;
use App\Models\DiversLog;
use App\Models\DivingApplication;
use App\Models\DivingLesson;
use App\Models\Equipment;
use App\Models\Rental;
use App\Models\User;
use App\Models\Vessel;
use App\Models\VesselService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        $employees = User::where('role', 'Employee')->count();
        $students = User::where('role', 'Student')->count();
        $surveys = User::where('role', 'Survey Client')->count();
        $rentals = User::where('role', 'Rental Client')->count();

        return view('employee.dashboard', compact('employees', 'students', 'surveys', 'rentals'));
    }

    public function equipments()
    {
        $equipments = Equipment::with('rentalItems.rental')->get();
        return view('employee.equipments', compact('equipments'));
    }

    public function rentals()
    {
        $rentals = Rental::with(['equipment', 'user'])
            ->whereIn('status', ['Pending', 'Confirmed', 'Released', 'Returned', 'Cancelled'])
            ->orderByRaw("FIELD(status, 'Pending', 'Confirmed', 'Released', 'Returned', 'Cancelled')")
            ->get();

        // Mark "Released" rentals as overdue if return_date has passed
        foreach ($rentals as $rental) {
            if (
                $rental->status === 'Released' &&
                now()->gt(\Carbon\Carbon::parse($rental->return_date))
            ) {
                $rental->status = 'Overdue'; // Virtual status for display only
            }
        }

        $users = User::where('role', 'Rental Client')->get();
        $allEquipment = Equipment::select('id', 'equipment_name', 'quantity')->get(); // fixed

        return view('employee.rentals', compact('rentals', 'users', 'allEquipment'));
    }

    public function lesson()
    {
        $divingLessons = DivingLesson::all();
        return view('employee.lesson', compact('divingLessons'));
    }

    public function students()
    {
        $students = User::where('role', 'Student')
            ->orderByRaw("FIELD(status, 'Active', 'Inactive')")
            ->get();
        return view('employee.students', compact('students'));
    }

    public function applications()
    {
        $divingApplications = DivingApplication::with(['user', 'lesson'])
            ->orderByRaw("FIELD(status, 'Pending', 'Approved', 'Ongoing', 'Completed', 'Rejected')")
            ->orderBy('created_at', 'desc')
            ->get();

        $users = User::where('role', 'Student')->get();
        $lessons = DivingLesson::all();

        return view('employee.applications', compact('divingApplications', 'users', 'lessons'));
    }

    public function services()
    {
        $services = VesselService::withCount('schedules')->get();
        return view('employee.services', compact('services'));
    }

    public function vessels()
    {
        $vessels = Vessel::all();
        $users = User::where('role', 'Survey Client')->get();
        return view('employee.vessels', compact('vessels', 'users'));
    }

    public function schedules()
    {
        $vessels = Vessel::all();
        $services = VesselService::all();
        $vesselSchedules = Vessel::with('schedules')->get();
        return view('employee.vessel-schedules', compact('vesselSchedules', 'vessels', 'services'));
    }

    public function inspection()
    {
        $vesselInspections = Vessel::whereHas('schedules', function ($query) {
            $query->where('status', 'Completed');
        })->with('inspections')->get();

        return view('employee.vessel-inspections', compact('vesselInspections'));
    }

    public function vesselSchedule($schedule_id)
    {
        $vesselSchedule = Vessel::whereHas('schedules', function ($query) use ($schedule_id) {
            $query->where('id', '=', $schedule_id);
        })->with(['schedules', 'inspections'])->first();

        if (!$vesselSchedule) {
            abort(404, 'Schedule not found');
        }

        $inspection = $vesselSchedule->schedules->first()->inspection;

        if (!$inspection) {
            abort(404, 'Inspection not found');
        }

        $vesselInspectionDetails = $inspection->details->map(function ($detail) {
            return [
                'id' => $detail->id,
                'title' => $detail->title,
                'description' => $detail->description,
                'remarks' => $detail->remarks,
            ];
        });

        return view('employee.vessel-schedule-details', compact('vesselSchedule', 'schedule_id', 'vesselInspectionDetails'));
    }

    public function vesselInspectionReport($schedule_id)
    {
        $vesselSchedule = Vessel::whereHas('schedules', function ($query) use ($schedule_id) {
            $query->where('id', '=', $schedule_id);
        })->with(['schedules', 'inspections'])->first();

        if (!$vesselSchedule) {
            abort(404, 'Schedule not found');
        }

        $inspection = $vesselSchedule->schedules->first()->inspection;

        if (!$inspection) {
            abort(404, 'Inspection not found');
        }

        $vesselInspectionDetails = $inspection->details->map(function ($detail) {
            $formattedTitle = $detail->title;

            // Default values to "N/A"
            $description = $detail->description ?? 'N/A';
            $marine_growth = $detail->marine_growth ?? 'N/A';
            $corrosion = $detail->corrosion ?? 'N/A';
            $paint_coating = $detail->paint_coating ?? 'N/A';

            // Specific logic for blade sections
            if (str_contains(strtolower($detail->title), 'blade')) {
                $description = "No visible indication of damage";
                $marine_growth = "Hard and Soft Marine Growth is present approximately 20% per m2";
                $corrosion = "No indication of corrosion";
                $paint_coating = "Remain intact and in generally good condition free from cracking";
            } elseif ($detail->title === '4. Rudder') {
                // Rudder only has description
                $marine_growth = null;
                $corrosion = null;
                $paint_coating = null;
            } elseif ($detail->title === '7. Portside Amidship Hull') {
                // Portside Amidship Hull has description and marine_growth
                $corrosion = null;
                $paint_coating = null;
            }

            return [
                'id' => $detail->id,
                'title' => $formattedTitle,
                'description' => $description,
                'marine_growth' => $marine_growth,
                'corrosion' => $corrosion,
                'paint_coating' => $paint_coating,
                'remarks' => $detail->remarks ?? 'N/A',
            ];
        });

        // Debug: Log titles to verify
        Log::info('Inspection Detail Titles: ' . json_encode($vesselInspectionDetails->pluck('title')->toArray()));

        $inspectionReport = (object) [
            'schedule_date' => $vesselSchedule->schedules->first()->schedule_date,
            'vessel_name' => $vesselSchedule->vessel_name,
            'vessel_owner' => $vesselSchedule->vessel_owner,
            'vessel_location' => $vesselSchedule->vessel_location,
            'imo_on' => $vesselSchedule->imo_on,
            'homeport' => $vesselSchedule->home_port,
            'place_of_built' => $vesselSchedule->place_of_built,
            'type_of_service' => $vesselSchedule->type_of_service,
            'length' => $vesselSchedule->length,
            'no_screws' => $vesselSchedule->no_screws,
            'breadth' => $vesselSchedule->breadth,
            'material' => $vesselSchedule->material,
            'depth' => $vesselSchedule->depth,
            'groostonnage' => $vesselSchedule->gross_tonnage,
            'engine' => $vesselSchedule->engine,
            'nettonnage' => $vesselSchedule->net_tonnage,
            'yearbuilt' => $vesselSchedule->year_built,
            'launch_date' => $vesselSchedule->launch_date,
            'horse_power' => $vesselSchedule->horse_power,
        ];

        return view('reports.vessels.vessel-inspection-reports', compact('vesselInspectionDetails', 'inspectionReport'));
    }

    public function sendVesselInspectionReport($schedule_id)
    {
        $vesselSchedule = Vessel::whereHas('schedules', function ($query) use ($schedule_id) {
            $query->where('id', '=', $schedule_id);
        })->with(['schedules', 'inspections', 'user'])->first();

        if (!$vesselSchedule) {
            abort(404, 'Schedule not found');
        }

        $inspection = $vesselSchedule->schedules->first()->inspection;

        if (!$inspection) {
            abort(404, 'Inspection not found');
        }

        $vesselInspectionDetails = $inspection->details->map(function ($detail) {
            $formattedTitle = $detail->title;
            $description = $detail->description ?? 'N/A';
            $marine_growth = $detail->marine_growth ?? 'N/A';
            $corrosion = $detail->corrosion ?? 'N/A';
            $paint_coating = $detail->paint_coating ?? 'N/A';

            if (str_contains(strtolower($detail->title), 'blade')) {
                $description = "No visible indication of damage";
                $marine_growth = "Hard and Soft Marine Growth is present approximately 20% per m2";
                $corrosion = "No indication of corrosion";
                $paint_coating = "Remain intact and in generally good condition free from cracking";
            } elseif ($detail->title === '4. Rudder') {
                $marine_growth = null;
                $corrosion = null;
                $paint_coating = null;
            } elseif ($detail->title === '7. Portside Amidship Hull') {
                $corrosion = null;
                $paint_coating = null;
            }

            return [
                'id' => $detail->id,
                'title' => $formattedTitle,
                'description' => $description,
                'marine_growth' => $marine_growth,
                'corrosion' => $corrosion,
                'paint_coating' => $paint_coating,
                'remarks' => $detail->remarks ?? 'N/A',
            ];
        });

        $inspectionReport = (object) [
            'schedule_date' => $vesselSchedule->schedules->first()->schedule_date,
            'vessel_name' => $vesselSchedule->vessel_name,
            'vessel_owner' => $vesselSchedule->vessel_owner,
            'vessel_location' => $vesselSchedule->vessel_location,
            'imo_on' => $vesselSchedule->imo_on,
            'homeport' => $vesselSchedule->home_port,
            'place_of_built' => $vesselSchedule->place_of_built,
            'type_of_service' => $vesselSchedule->type_of_service,
            'length' => $vesselSchedule->length,
            'no_screws' => $vesselSchedule->no_screws,
            'breadth' => $vesselSchedule->breadth,
            'material' => $vesselSchedule->material,
            'depth' => $vesselSchedule->depth,
            'groostonnage' => $vesselSchedule->gross_tonnage,
            'engine' => $vesselSchedule->engine,
            'nettonnage' => $vesselSchedule->net_tonnage,
            'yearbuilt' => $vesselSchedule->year_built,
            'launch_date' => $vesselSchedule->launch_date,
            'horse_power' => $vesselSchedule->horse_power,
        ];

        // Generate PDF from Blade view
        $pdf = Pdf::loadView('reports.vessels.vessel-inspection-reports', compact('vesselInspectionDetails', 'inspectionReport'))->output();

        // Get vessel owner email
        $ownerEmail = $vesselSchedule->user->email ?? null;

        if ($ownerEmail) {
            Mail::to($ownerEmail)->send(new VesselInspectionReportMail($pdf));
        }

        return back()->with('success', 'Inspection report emailed successfully.');
    }
}
