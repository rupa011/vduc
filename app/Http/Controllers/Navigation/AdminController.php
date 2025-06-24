<?php

namespace App\Http\Controllers\Navigation;

use App\Http\Controllers\Controller;
use App\Mail\VesselInspectionReportMail;
use App\Models\User;
use App\Models\Vessel;
use App\Models\Equipment; // Add this import
use App\Models\DivingLesson;


use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Mail;

class AdminController extends Controller
{
    public function dashboard()
    {
        $employees = User::where('role', 'Employee')->count();
        $students = User::where('role', 'Student')->count();
        $surveys = User::where('role', 'Survey Client')->count();
        $rentals = User::where('role', 'Rental Client')->count();

        return view('admin.dashboard', compact('employees', 'students', 'surveys', 'rentals'));
    }

    public function employees()
    {
        $employees = User::where('role', 'Employee')->get();
        return view('admin.employees', compact('employees'));
    }

    public function students()
    {
        $students = User::where('role', 'Student')->get();
        return view('admin.students', compact('students'));
    }

    public function surveys()
    {
        $surveys = User::where('role', 'Survey Client')->get();
        return view('admin.surveys', compact('surveys'));
    }

    public function rentals()
    {
        $rentals = User::where('role', 'Rental Client')->get();
        return view('admin.rentals', compact('rentals'));
    }

    public function messages()
    {
        $employees = User::where('role', 'Employee')->get();
        return view('admin.messages', compact('employees'));
    }

    public function sendSms(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'message' => 'required|string|max:500',
        ]);

        $employee = User::findOrFail($request->employee_id);

        // Format phone number to international format
        $phone = preg_replace('/^(0)/', '63', $employee->contact); // 0917... → 63917...

        $response = Http::asForm()->post('https://sms.iprogtech.com/api/v1/sms_messages', [
            'api_token' => '71f75068f095b76e1610e1f8f0c6f00b534805fa',
            'message' => $request->message,
            'phone_number' => $phone,
        ]);

        if ($response->successful()) {
            return back()->with('success', 'SMS sent successfully!');
        } else {
            return back()->with('error', 'Failed to send SMS. Please try again.');
        }
   }

   public function equipments()
    {
        $equipments = Equipment::with('rentalItems.rental')->get();
        return view('admin.equipments', compact('equipments'));
    }

    public function lesson()
    {
        $divingLessons = DivingLesson::all(); // Fetch all diving lessons
        return view('admin.lesson', compact('divingLessons')); // Updated view path
    }

    public function vesselInspectionReport($schedule_id)
    {
        $vesselSchedule = Vessel::whereHas('schedules', fn($q) => $q->where('id', $schedule_id))
            ->with(['schedules', 'inspections'])->firstOrFail();

        $inspection = $vesselSchedule->schedules->first()->inspection;
        if (!$inspection) abort(404, 'Inspection not found');

        $vesselInspectionDetails = $inspection->details->map(function ($detail) {
            $desc = $detail->description ?? 'N/A';
            $marine_growth = $detail->marine_growth ?? 'N/A';
            $corrosion = $detail->corrosion ?? 'N/A';
            $paint_coating = $detail->paint_coating ?? 'N/A';

            if (str_contains(strtolower($detail->title), 'blade')) {
                $desc = "No visible indication of damage";
                $marine_growth = "Hard and Soft Marine Growth is present approximately 20% per m2";
                $corrosion = "No indication of corrosion";
                $paint_coating = "Remain intact and in generally good condition free from cracking";
            } elseif ($detail->title === '4. Rudder') {
                $marine_growth = $corrosion = $paint_coating = null;
            } elseif ($detail->title === '7. Portside Amidship Hull') {
                $corrosion = $paint_coating = null;
            }

            return [
                'id' => $detail->id,
                'title' => $detail->title,
                'description' => $desc,
                'marine_growth' => $marine_growth,
                'corrosion' => $corrosion,
                'paint_coating' => $paint_coating,
                'remarks' => $detail->remarks ?? 'N/A',
            ];
        });

        $vessel = $vesselSchedule;
        $sched = $vessel->schedules->first();

        $inspectionReport = (object) [
            'schedule_date' => $sched->schedule_date,
            'vessel_name' => $vessel->vessel_name,
            'vessel_owner' => $vessel->vessel_owner,
            'vessel_location' => $vessel->vessel_location,
            'imo_on' => $vessel->imo_on,
            'homeport' => $vessel->home_port,
            'place_of_built' => $vessel->place_of_built,
            'type_of_service' => $vessel->type_of_service,
            'length' => $vessel->length,
            'no_screws' => $vessel->no_screws,
            'breadth' => $vessel->breadth,
            'material' => $vessel->material,
            'depth' => $vessel->depth,
            'groostonnage' => $vessel->gross_tonnage,
            'engine' => $vessel->engine,
            'nettonnage' => $vessel->net_tonnage,
            'yearbuilt' => $vessel->year_built,
            'launch_date' => $vessel->launch_date,
            'horse_power' => $vessel->horse_power,
        ];

        return view('reports.vessels.vessel-inspection-reports', compact('vesselInspectionDetails', 'inspectionReport'));
    }

    public function sendVesselInspectionReport($schedule_id)
    {
        $vesselSchedule = Vessel::whereHas('schedules', fn($q) => $q->where('id', $schedule_id))
            ->with(['schedules', 'inspections', 'user'])->firstOrFail();

        $inspection = $vesselSchedule->schedules->first()->inspection;
        if (!$inspection) abort(404, 'Inspection not found');

        $vesselInspectionDetails = $inspection->details->map(function ($detail) {
            $desc = $detail->description ?? 'N/A';
            $marine_growth = $detail->marine_growth ?? 'N/A';
            $corrosion = $detail->corrosion ?? 'N/A';
            $paint_coating = $detail->paint_coating ?? 'N/A';

            if (str_contains(strtolower($detail->title), 'blade')) {
                $desc = "No visible indication of damage";
                $marine_growth = "Hard and Soft Marine Growth is present approximately 20% per m2";
                $corrosion = "No indication of corrosion";
                $paint_coating = "Remain intact and in generally good condition free from cracking";
            } elseif ($detail->title === '4. Rudder') {
                $marine_growth = $corrosion = $paint_coating = null;
            } elseif ($detail->title === '7. Portside Amidship Hull') {
                $corrosion = $paint_coating = null;
            }

            return [
                'id' => $detail->id,
                'title' => $detail->title,
                'description' => $desc,
                'marine_growth' => $marine_growth,
                'corrosion' => $corrosion,
                'paint_coating' => $paint_coating,
                'remarks' => $detail->remarks ?? 'N/A',
            ];
        });

        $sched = $vesselSchedule->schedules->first();

        $inspectionReport = (object) [
            'schedule_date' => $sched->schedule_date,
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

        $pdf = Pdf::loadView('reports.vessels.vessel-inspection-reports', compact('vesselInspectionDetails', 'inspectionReport'))->output();

        $email = $vesselSchedule->user->email ?? null;
        if ($email) {
            Mail::to($email)->send(new VesselInspectionReportMail($pdf));
        }

        return back()->with('success', 'Inspection report emailed successfully.');
    }
}
