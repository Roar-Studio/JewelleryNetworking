<?php

namespace App\Listeners;

use App\Events\PaymentSuccess;
use App\Mail\PaymentSuccessMail;
use App\Models\DDA;
use App\Models\DdaTransaction;
use App\Services\InvoiceService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendPaymentSuccessMail
{
    /**
     * The invoice generation service.
     *
     * @var InvoiceService
     */
    protected InvoiceService $invoiceService;

    /**
     * Create the event listener.
     */
    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentSuccess $event): void
    {
        /* 1. Find the entry */
        $submission = DDA::findOrFail($event->entry_id);

        /* 2. Find the valid transaction */
        $transaction = DdaTransaction::findOrFail($event->transaction_id);

        /* 3. Generate the invoice number if it doesn't already exist */
        if (empty($transaction->invoice_number)) {
            $transaction->invoice_number = 'INV-' . now()->year . '-' . str_pad($transaction->id, 6, '0', STR_PAD_LEFT);
            $transaction->save();
        }

        /* 4. Generate the invoice PDF and send the email, guarding against failures */
        try {
            $invoicePdf = $this->invoiceService->generate($submission, $transaction);

            Mail::to($submission->email)->send(
                (new PaymentSuccessMail($submission, $transaction))->attachData(
                    $invoicePdf->output(),
                    'Invoice-' . $submission->entry_id . '.pdf',
                    [
                        'mime' => 'application/pdf',
                    ]
                )
            );
        } catch (Throwable $exception) {
            Log::error('Failed to generate invoice or send payment success email.', [
                'submission_id' => $submission->id,
                'transaction_id' => $transaction->id,
                'exception_message' => $exception->getMessage(),
                'exception_trace' => $exception->getTraceAsString(),
            ]);
        }
    }
}