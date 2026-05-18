<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpiryNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $expiry_date, $membership_type, $benefits, $status;

    public function __construct($name, $expiry_date, $membership_type, $benefits, $status)
    {
        $this->name = $name;
        $this->expiry_date = $expiry_date;
        $this->membership_type = $membership_type;
        $this->benefits = $benefits;
        $this->status = $status; // New property to indicate if the plan is expired or expiring
    }

    public function build()
    {
        return $this->subject('Stay Connected — Your '.$this->membership_type.' Membership is About to Expire')
                    ->view('email.expiry_notification');
    }
}
