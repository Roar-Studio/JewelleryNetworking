<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuspiciousLoginMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $attempted_email_id;
    public $ip_address;
    public $login_datetime;
    public $device_id;
    public $browser_info;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $attempted_email_id, $ip_address, $login_datetime, $device_id, $browser_info)
    {
        $this->name = $name;
        $this->attempted_email_id = $attempted_email_id;
        $this->ip_address = $ip_address;
        $this->login_datetime = $login_datetime;
        $this->device_id = $device_id;
        $this->browser_info = $browser_info;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Suspicious Login Attempt Detected')
                    ->view('email.suspicious_login');
    }
}
