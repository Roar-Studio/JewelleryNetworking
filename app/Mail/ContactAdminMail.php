<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $first_name, $last_name, $company_name, $country, $email, $mobile_no, $text_message, $submission_date;

    public function __construct($first_name, $last_name, $company_name, $country, $email, $mobile_no, $text_message, $submission_date)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->company_name = $company_name;
        $this->country = $country;
        $this->email = $email;
        $this->mobile_no = $mobile_no;
        $this->text_message = $text_message;
        $this->submission_date = $submission_date;
    }

    public function build()
    {
        return $this->subject('New Contact Us Query from ' . $this->first_name . ' ' . $this->last_name)
                    ->view('email.contact_admin');
    }
}
