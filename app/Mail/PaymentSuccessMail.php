<?php

namespace App\Mail;

use App\Models\DDA;
use App\Models\DdaTransaction;
use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The DDA submission instance.
     *
     * @var DDA
     */
    public DDA $submission;

    /**
     * The DDA transaction instance.
     *
     * @var DdaTransaction
     */
    public DdaTransaction $transaction;

    /**
     * Create a new message instance.
     */
    public function __construct(DDA $submission, DdaTransaction $transaction)
    {
        $this->submission = $submission;
        $this->transaction = $transaction;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Confirmation - Deities Design Awards',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.payment-success',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}