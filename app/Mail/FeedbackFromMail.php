<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackFromMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rating;
    public $feedback;
    public $toName;
    public $fromName;

    /**
     * Create a new message instance.
     */
    public function __construct($fromName, $toName, $rating, $feedback)
    {
        $this->fromName = $fromName;       // Name of the person receiving feedback
        $this->toName = $toName;       // Name of the person receiving feedback
        $this->rating = $rating;
        $this->feedback = $feedback;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Thank You for Sharing Your Feedback')
                    ->view('email.feedback-from');
    }
}
