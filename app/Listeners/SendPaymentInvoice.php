<?php

namespace App\Listeners;

use App\Events\PaymentSuccess;
use App\Models\DDA;
use App\Models\DdaTransaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendPaymentInvoice
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
    public function handle(PaymentSuccess $event): void
    {
        /* 1. Find the entry */
        $submission = DDA::findOrFail($event->entry_id);
        /* 2. Find the valid transaction */
        $trasaction = DdaTransaction::findOrFail($event->transaction_id);
        /* 3. Send the email to the participants with pdf with his / her submission details */
        /* TODO: Create a proper mail template for this */
        Mail::raw(
            "Your payment was successfull",
            function($message) use ($submission){
                $message->to($submission->email)->subject("Payment Sucessfull");
            }
        );
    }
}
