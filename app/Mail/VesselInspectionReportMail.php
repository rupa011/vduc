<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VesselInspectionReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;

    public function __construct($pdf)
    {
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this->subject('Your Vessel Inspection Report')
            ->view('emails.vessel_inspection_notification')
            ->attachData($this->pdf, 'vessel-inspection-report.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
