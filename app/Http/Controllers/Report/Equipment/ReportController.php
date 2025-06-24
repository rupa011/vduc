<?php

namespace App\Http\Controllers\Report\Equipment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Services\Reports\ReportFactory;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.equipments.select', ['options' => ReportFactory::options()]);
    }

    public function show(Request $request)
    {
        $type = $request->input('report_type');
        $report = ReportFactory::make($type);

        if (!$report) {
            return redirect()->back()->withErrors('Invalid report type.');
        }

        return view('reports.equipments.view', [
            'data' => $report->getData(),
            'title' => $report->getTitle(),
            'view' => $report->getView(),
            'type' => $type,
        ]);
    }

    public function export(Request $request)
    {
        $type = $request->input('type');
        $report = ReportFactory::make($type);

        if (!$report) {
            return redirect()->back()->withErrors('Invalid report type.');
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView($report->getView(), [
            'data' => $report->getData(),
            'title' => $report->getTitle()
        ]);

        return $pdf->download("{$type}_report.pdf");
    }

    public function render(Request $request)
    {
        $type = $request->input('report_type');
        $report = ReportFactory::make($type);

        if (!$report) {
            return response('Invalid report type.', 400);
        }

        // dd($report->getData());

        return view('reports.equipments.view_inline', [
            'data' => $report->getData(),
            'title' => $report->getTitle(),
            'view' => $report->getView(),
            'type' => $type,
        ]);
    }

   public function print(Request $request)
{
    $type = $request->input('type');
    $report = ReportFactory::make($type);

    if (!$report) {
        return redirect()->back()->withErrors('Invalid report type.');
    }

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.vessels.vessel-inspection-reports', [
        'data' => $report->getData(),
        'title' => $report->getTitle()
    ]);

    return $pdf->stream("{$type}_report.pdf", ['Attachment' => false]);
}
}
