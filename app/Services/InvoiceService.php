<?php

namespace App\Services;

use App\Models\DDA;
use App\Models\DdaTransaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as PdfInstance;

class InvoiceService
{
    /**
     * Generate the invoice PDF for a given submission and transaction.
     *
     * @param  DDA            $submission
     * @param  DdaTransaction $transaction
     * @return PdfInstance
     */
    public function generate(DDA $submission, DdaTransaction $transaction): PdfInstance
    {
        return Pdf::loadView(
            'invoices.invoice',
            compact('submission', 'transaction')
        );
    }
}