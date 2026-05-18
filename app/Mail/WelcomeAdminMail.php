<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $membershipId;

    /**
     * Create a new message instance.
     *
     * @param  object|array  $customer
     * @param  string|null   $membershipId
     */
    public function __construct($customer, $membershipId)
    {
        $this->customer = $customer;
        $this->membershipId = $membershipId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $customerName = $this->customer->first_name ?? 'New Customer';

        return $this->subject("New Customer Registered - {$customerName} On Jewellery Networking")
                    ->with([
                        'customer'      => $this->customer,
                        'membershipId'  => $this->membershipId
                    ])
                    ->view('email.welcomeadmin');
    }
}

