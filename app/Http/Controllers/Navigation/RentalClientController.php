<?php

namespace App\Http\Controllers\Navigation;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;

class RentalClientController extends Controller
{

    /**
     * Display the rental dashboard for the authenticated user.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $user = auth()->user();
        $rentalsCount = Rental::where('user_id', $user->id)
            ->whereIn('status', ['Pending', 'Confirmed', 'Released', 'Returned', 'Cancelled'])
            ->count();

        return view('rental.dashboard', compact('user', 'rentalsCount'));
    }

    public function divingGear()
    {
        $equipments = Equipment::where('category', 'Personal Diving Gear')
            ->orderBy('equipment_name')
            ->get();

        return view('rental.diving_gear', compact('equipments'));
    }

    public function breathingApparatus()
    {
        $equipments = Equipment::where('category', 'Breathing Apparatus')
            ->orderBy('equipment_name')
            ->get();

        return view('rental.breathing_apparatus', compact('equipments'));
    }

    public function diveInstruments()
    {
        $equipments = Equipment::where('category', 'Dive Instruments')
            ->orderBy('equipment_name')
            ->get();

        return view('rental.dive_instruments', compact('equipments'));
    }

    public function communicationSafetyTools()
    {
        $equipments = Equipment::where('category', 'Communication & Safety Tools')
            ->orderBy('equipment_name')
            ->get();

        return view('rental.communication_safety_tools', compact('equipments'));
    }

    public function specializedSurveyEquipment()
    {
        $equipments = Equipment::where('category', 'Specialized Survey Equipment')
            ->orderBy('equipment_name')
            ->get();

        return view('rental.specialized_survey_equipment', compact('equipments'));
    }

    public function rentals()
    {
        $user = auth()->user();
        $rentals = Rental::with(['equipment', 'user'])
            ->whereIn('status', ['Pending', 'Confirmed', 'Released', 'Returned', 'Cancelled'])
            ->where('user_id', '=', $user->id)
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

        $allEquipment = Equipment::select('id', 'equipment_name', 'quantity')->get(); // fixed

        return view('rental.rentals', compact('rentals', 'user', 'allEquipment'));
    }
}
