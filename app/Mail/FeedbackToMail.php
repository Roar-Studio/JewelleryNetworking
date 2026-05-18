<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackToMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rating;
    public $feedback;
    public $fromName;
    public $toName;

    /**
     * Create a new message instance.
     */
    public function __construct($fromName, $toName, $rating, $feedback)
    {
        $this->fromName = $fromName;   // Name of the person who gave feedback
        $this->toName = $toName;   // Name of the person who received feedback
        $this->rating = $rating;
        $this->feedback = $feedback;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Feedback Submission')
                    ->view('email.feedback-to');
    }
}
