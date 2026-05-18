<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $membershipId;

    public function __construct($name, $membershipId)
    {
        $this->name = $name;
        $this->membershipId = $membershipId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {              
        return $this->subject('Welcome to Jewellery Networking. You\'re All Set!')
                    ->with([
                        'name' => $this->name,
                        'membershipId' => $this->membershipId,
                    ])
                    ->view('email.welcome');
    }
}

