<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\EquipmentRentalItem;
use App\Models\RentalItemStatus;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class EquipmentReportController extends Controller
{
    public function index(Request $request)
    {
        $statuses = RentalItemStatus::with(['equipment', 'rental.user']);
        $rentalItems = EquipmentRentalItem::with(['equipment', 'rental.user']);
        $users = User::where('role', 'Rental Client')->get();

        if ($request->filled('user_id')) {
            $rentalItems->whereHas('rental', fn($q) => $q->where('user_id', $request->user_id));
            $statuses->whereHas('rental', fn($q) => $q->where('user_id', $request->user_id));
        }

        if ($request->filled('from') && $request->filled('to')) {
            $rentalItems->whereHas('rental', fn($q) => $q->whereBetween('pick_up_date', [$request->from, $request->to]));
            $statuses->whereHas('rental', fn($q) => $q->whereBetween('pick_up_date', [$request->from, $request->to]));
        }

        return view('reports.equipment', [
            'equipment' => Equipment::all(),
            'rentalItems' => $rentalItems->get(),
            'statuses' => $statuses->get(),
            'users' => $users,
        ]);
    }

    public function exportPdf(Request $request)
    {
        $statuses = RentalItemStatus::with(['equipment', 'rental.user']);
        $rentalItems = EquipmentRentalItem::with(['equipment', 'rental.user']);

        if ($request->filled('user_id')) {
            $rentalItems->whereHas('rental', fn($q) => $q->where('user_id', $request->user_id));
            $statuses->whereHas('rental', fn($q) => $q->where('user_id', $request->user_id));
        }

        if ($request->filled('from') && $request->filled('to')) {
            $rentalItems->whereHas('rental', fn($q) => $q->whereBetween('pick_up_date', [$request->from, $request->to]));
            $statuses->whereHas('rental', fn($q) => $q->whereBetween('pick_up_date', [$request->from, $request->to]));
        }

        $pdf = PDF::loadView('reports.equipment', [
            'equipment' => Equipment::all(),
            'rentalItems' => $rentalItems->get(),
            'statuses' => $statuses->get(),
            'users' => User::where('role', 'Rental Client')->get(),
        ]);

        return $pdf->download('equipment_report.pdf');
    }
}
