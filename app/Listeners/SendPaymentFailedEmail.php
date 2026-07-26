<?php

namespace App\Listeners;

use App\Events\PaymentFailed;
use App\Mail\PaymentFailedMail;
use App\Models\DDA;
use App\Models\DdaTransaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendPaymentFailedEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentFailed $event): void
    {
        /* 1. Find the submission */
        $submission = DDA::findOrFail($event->entry_id);

        /* 2. Find the transaction */
        $transaction = DdaTransaction::findOrFail($event->transaction_id);

        try {

            /* 3. Send the professional payment failed email */
            Mail::to($submission->email)->send(
                new PaymentFailedMail($submission, $transaction)
            );

        } catch (Throwable $exception) {

            Log::error('Failed to send payment failed email.', [
                'submission_id'      => $submission->id,
                'transaction_id'     => $transaction->id,
                'exception_message'  => $exception->getMessage(),
                'exception_trace'    => $exception->getTraceAsString(),
            ]);
        }
    }
}