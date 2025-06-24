<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\EquipmentRentalItem;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
class RentalReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Rental::with('user');

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('pick_up_date', [$request->from, $request->to]);
        }

        return view('reports.rental', [
            'rentals' => $query->get(),
            'rentalItems' => EquipmentRentalItem::with('equipment', 'rental')->get(),
            'users' => User::where('role', 'Rental Client')->get(),
        ]);
    }

    public function exportPdf(Request $request)
    {
        $query = Rental::with('user');

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('pick_up_date', [$request->from, $request->to]);
        }

        $pdf = PDF::loadView('reports.rental', [
            'rentals' => $query->get(),
            'rentalItems' => EquipmentRentalItem::with('equipment', 'rental')->get(),
            'users' => User::where('role', 'Rental Client')->get(),
        ]);

        return $pdf->download('rental_report.pdf');
    }
}
