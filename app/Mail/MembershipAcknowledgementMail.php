<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Helpers\Helper;

class MembershipAcknowledgementMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $expiry_date, $membership_type, $benefits, $order_id;

    public function __construct($name, $expiry_date, $membership_type, $benefits, $order_id)
    {
        $this->name = $name;
        $this->expiry_date = $expiry_date;
        $this->membership_type = $membership_type;
        $this->benefits = $benefits;
        $this->order_id = $order_id;
    }

    public function build()
    {
        // PDF binary generate karo Helper se
        $pdfData = Helper::generateInvoicePdf($this->order_id);

        return $this->subject('Welcome to Your New '. $this->membership_type .' Membership! ✨')
                    ->view('email.membership_acknowledgement')
                    ->attachData(
                        $pdfData, 
                        'Invoice-'.$this->order_id.'.pdf', 
                        [
                            'mime' => 'application/pdf',
                        ]
                    );
    }
}
