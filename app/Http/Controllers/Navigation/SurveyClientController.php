<?php

namespace App\Http\Controllers\Navigation;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vessel;
use App\Models\VesselService;
use Illuminate\Http\Request;

class SurveyClientController extends Controller
{

    public function dashboard()
    {
        // Logic for the survey client dashboard
        return view('survey.dashboard');
    }

    public function services()
    {
        $services = VesselService::all();
        $vessels = Vessel::where('user_id', auth()->id())->get();
        return view('survey.services', compact('vessels', 'services'));
    }

    public function vessels()
    {
        $vessels = Vessel::where('user_id', auth()->id())->get();
        return view('survey.vessels', compact('vessels'));
    }

    public function vesselSchedules()
    {
        $vessels = Vessel::where('user_id', auth()->id())->get();
        $services = VesselService::all();
        $vesselSchedules = Vessel::with('schedules')->where('user_id', auth()->id())->get();
        // dd($vesselSchedules);
        return view('survey.vessel_schedules', compact('vessels', 'services', 'vesselSchedules'));
    }

    public function vesselInspections()
    {
        $vesselInspections = Vessel::whereHas('schedules', function ($query) {
            $query->where('status', 'Completed')
            ->where('user_id', auth()->id());
        })->with('inspections')->get();

        return view('survey.vessel_inspections', compact('vesselInspections'));
    }
}
