<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Helpers\Helper;

class EventRegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $event_name, $venue_address, $google_meet_link, $event_start_datetime, $order_id, $membershipId;

    public function __construct($name, $event_name, $venue_address, $google_meet_link, $event_start_datetime, $order_id, $membershipId = null)
    {
        $this->name = $name;
        $this->event_name = $event_name;
        $this->venue_address = $venue_address;
        $this->google_meet_link = $google_meet_link;
        $this->event_start_datetime = $event_start_datetime;
        $this->order_id = $order_id;
        $this->membershipId = $membershipId;
    }

    public function build()
    {
        // PDF binary generate karo Helper se
        $pdfData = Helper::generateInvoicePdf($this->order_id);

        return $this->subject('Event Registration Confirmed – '. $this->event_name)
                    ->view('email.event_registered')
                    ->attachData(
                        $pdfData, 
                        'Invoice-'.$this->order_id.'.pdf', 
                        [
                            'mime' => 'application/pdf',
                        ]
                    );
    }
}
