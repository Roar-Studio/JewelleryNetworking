<?php

namespace App\Listeners;

use App\Events\PaymentFailed;
use App\Models\DDA;
use App\Models\DdaTransaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

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
        /* 1. Find the entry */
        $submission = DDA::findOrFail($event->entry_id);
        /* 2. Find the valid transaction */
        $trasaction = DdaTransaction::findOrFail($event->transaction_id);
        /* 3. Send the email to the participants with pdf with his / her submission details */
        /* TODO: Create a proper mail template for this */
        Mail::raw(
            "Your payment was failed",
            function ($message) use ($submission) {
                $message->to($submission->email)->subject("Payment Failed");
            }
        );
    }
}
