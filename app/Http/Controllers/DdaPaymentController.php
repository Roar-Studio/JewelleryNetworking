<?php

namespace App\Http\Controllers;

use App\Models\DDA;
use App\Models\DdaTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Razorpay\Api\Api;

class DdaPaymentController extends Controller
{
    public function orderSummary($id)
    {
        $submission = DDA::findOrFail($id);

        $amount = config('dda.entry_fee');

        return view(
            'deitiesdesignawards.payment.order-summary',
            compact('submission', 'amount')
        );
    }

    public function createOrder(Request $request)
    {
        try {

            $submission = DDA::findOrFail($request->submission_id);

            $amount = config('dda.entry_fee');

            /*
            |--------------------------------------------------------------------------
            | Create Transaction
            |--------------------------------------------------------------------------
            */

            $transaction = DdaTransaction::create([
                'dda_id' => $submission->id,
                'gateway' => 'razorpay',
                'transaction_no' => 'DDA-'.strtoupper(Str::random(12)),
                'amount' => $amount,
                'currency' => 'INR',
                'status' => 'Pending',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Razorpay API
            |--------------------------------------------------------------------------
            */

            try {

                $api = new Api(
                    env('RAZORPAY_KEY'),
                    env('RAZORPAY_SECRET')
                );

            } catch (\Exception $e) {

                dd($e->getMessage());

            }

            /*
            |--------------------------------------------------------------------------
            | Create Razorpay Order
            |--------------------------------------------------------------------------
            */

            $order = $api->order->create([
                'receipt' => (string) $transaction->id,
                'amount' => $amount * 100,
                'currency' => 'INR',
                'payment_capture' => 1,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Save Razorpay Order ID
            |--------------------------------------------------------------------------
            */

            $transaction->update([
                'gateway_order_id' => $order['id'],
            ]);

            /*
            |--------------------------------------------------------------------------
            | Return JSON
            |--------------------------------------------------------------------------
            */

            return response()->json([
                'success' => true,
                'key' => env('RAZORPAY_KEY'),
                'amount' => $amount * 100,
                'submission_id' => $submission->id,
                'transaction_id' => $transaction->id,
                'razorpay_order_id' => $order['id'],
                'name' => 'Deities Design Awards',
                'email' => $submission->email,
                'phone' => $submission->phone,
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);

        }
    }

    public function razorpayCallback(Request $request)
    {
        try {

            $transaction = DdaTransaction::findOrFail($request->transaction_id);

            $api = new Api(
                env('RAZORPAY_KEY'),
                env('RAZORPAY_SECRET')
            );

            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);


            $transaction->update([
                'gateway_payment_id' => $attributes['razorpay_payment_id'],
                'gateway_signature' => $attributes['razorpay_signature'],
                'status' => 'Completed',
            ]);

            return response()->json([
                'success' => true,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);

        }
    }

    public function paymentSuccess()
    {
        return view('deitiesdesignawards.payment.success');
    }

    public function paymentFailed()
    {
        return view('deitiesdesignawards.payment.failed');
    }
}
