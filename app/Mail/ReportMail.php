<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;
    public $start_date;
    public $end_date;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf, $start_date, $end_date)
    {
        $this->pdf = $pdf;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.report')
                    ->with([
                        'start_date' => $this->start_date,
                        'end_date' => $this->end_date,
                    ])
                    ->attachData($this->pdf, 'report.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
