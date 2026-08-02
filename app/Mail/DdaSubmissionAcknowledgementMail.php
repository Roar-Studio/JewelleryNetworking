<?php

namespace App\Mail;

use App\Models\DDA;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DdaSubmissionAcknowledgementMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The DDA submission instance.
     *
     * @var DDA
     */
    public DDA $submission;



    /**
     * Create a new message instance.
     */
    public function __construct(DDA $submission)
    {

        $this->submission = $submission;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Dda Submission Acknowledgement Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.submission-created',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
