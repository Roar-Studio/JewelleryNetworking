<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TransactionDetail;

class Helper
{
    public static function storeBase64Image($base64String, $folder = 'uploads', $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'])
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $base64String, $matches)) {
            $imageType = strtolower($matches[1]);

            if (!in_array($imageType, $allowedTypes)) {
                throw new \Exception('Unsupported image type: ' . $imageType);
            }

            $base64String = substr($base64String, strpos($base64String, ',') + 1);
            $decodedImage = base64_decode($base64String);

            if ($decodedImage === false) {
                throw new \Exception('Base64 decode failed.');
            }

            $filename = $folder . '/' . Str::uuid() . '.' . $imageType;
            Storage::disk('public')->put($filename, $decodedImage);

            return $filename;
        }

        throw new \Exception('Invalid base64 image format.');
    }

    public static function storeBase64Video($base64String, $folder = 'uploads', $allowedTypes = ['mp4', 'avi', 'mov'])
    {
        if (preg_match('/^data:video\/(\w+);base64,/', $base64String, $matches)) {
            $videoType = strtolower($matches[1]);

            if (!in_array($videoType, $allowedTypes)) {
                throw new \Exception('Unsupported video type: ' . $videoType);
            }

            $base64String = substr($base64String, strpos($base64String, ',') + 1);
            $decodedVideo = base64_decode($base64String);

            if ($decodedVideo === false) {
                throw new \Exception('Base64 decode failed.');
            }

            $filename = $folder . '/' . Str::uuid() . '.' . $videoType;
            Storage::disk('public')->put($filename, $decodedVideo);

            return $filename;
        }

        throw new \Exception('Invalid base64 video format.');
    }

    public static function storeBase64File($base64String, $folder = 'uploads', $allowedMimeTypes = [])
    {
        // Pattern to extract the MIME type
        if (preg_match('/^data:(.*?);base64,/', $base64String, $matches)) {
            $mimeType = strtolower(trim($matches[1]));

            // Optional: Restrict to allowed MIME types
            if (!empty($allowedMimeTypes) && !in_array($mimeType, $allowedMimeTypes)) {
                throw new \Exception('Unsupported file type: ' . $mimeType);
            }

            // Get file extension from MIME
            $extension = self::mimeToExtension($mimeType);
            if (!$extension) {
                throw new \Exception('Unknown file extension for MIME type: ' . $mimeType);
            }

            // Strip the base64 prefix and decode
            $base64String = substr($base64String, strpos($base64String, ',') + 1);
            $decodedFile = base64_decode($base64String);

            if ($decodedFile === false) {
                throw new \Exception('Base64 decode failed.');
            }

            // Save file
            $filename = $folder . '/' . Str::uuid() . '.' . $extension;
            Storage::disk('public')->put($filename, $decodedFile);

            return $filename;
        }

        throw new \Exception('Invalid base64 file format.');
    }

    public static function mimeToExtension($mimeType)
    {
        $map = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
            'application/pdf' => 'pdf',
            'application/msword' => 'doc',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'application/vnd.ms-excel' => 'xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            'text/plain' => 'txt',
            'application/zip' => 'zip',
            'application/json' => 'json',
            // Add more as needed
        ];

        return $map[$mimeType] ?? null;
    }

    /**
     * Generate invoice PDF and return as binary (string)
     */
    public static function generateInvoicePdf($order_id)
    {
        $txn = TransactionDetail::with('transactionable', 'customer')
            ->where('status', 'completed')
            ->where('order_id', $order_id)
            ->firstOrFail();

        if ($txn->transactionable instanceof \App\Models\Event) {
            $name = $txn->transactionable->name;
        } elseif ($txn->transactionable instanceof \App\Models\MembershipPlan) {
            $name = $txn->transactionable->name . ' Membership';
        }

        $invoiceData = [
            'invoice_no' => $txn->order_id,
            'order_date' => $txn->transaction_date,
            'payment_method' => $txn->payment_method,
            'currency_type' => $txn->currency_type,
            'bill_to' => [
                'name' => $txn->customer?->first_name
                    ? trim($txn->customer?->first_name . ' ' . $txn->customer?->last_name)
                    : trim($txn->payer_first_name . ' ' . $txn->payer_last_name),
                'company' => $txn->customer?->company_name ?? $txn->payer_company_name,
                'address' => $txn->customer?->company_address ?? $txn->payer_company_address,
                'email' => $txn->payer_email,
                'phone' => ($txn->payer_mobile_no_cc ?? '+91') . $txn->payer_mobile_no,
                'trn_no' => $txn->customer?->trn_no ?? $txn->payer_taxid,
            ],
            'from' => [
                'company' => 'Jewellery Networking',
                'address' => '1st Floor, Flat no. 102 Wing D, Rustamjee Elita, Andheri West, Mumbai 400053',
                'tax_id' => '27AKUPM5565G1ZI',
            ],
            'items' => [
                [
                    'product' => $name,
                    'quantity' => 1,
                    'unit_price' => $txn->price,
                    'total_price' => $txn->total_amount,
                ],
            ],
            'subtotal' => $txn->price,
            'tax' => $txn->gst,
            'discount' => $txn->discount,
            'total' => $txn->total_amount,
        ];

        $pdf = Pdf::loadView('frontend.invoice', $invoiceData)->setPaper('A4', 'portrait');

        // Yahin main difference: stream nahi, output return
        return $pdf->output();
    }

}
