<?php

namespace App\Http\Controllers;

use App\Events\PaymentFailed;
use App\Events\PaymentSuccess;
use App\Models\DDA;
use App\Models\DdaTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalHttp\HttpException;

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
                'transaction_no' => 'DDA-' . strtoupper(Str::random(12)),
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
                    'rzp_live_P5HDJtaQPAUv2F',
                    '1bhHKP6KX1ApHjtM0lxzEq1N'
                );
            } catch (\Exception $e) {
                Log::error('Razorpay API Initialization Failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
             'trace' => $e->getTraceAsString(),
    ]);
                dd($e->getMessage());
            }

            /*
            |--------------------------------------------------------------------------
            | Create Razorpay Order
            |--------------------------------------------------------------------------
            */
            
            Log::info('Creating Razorpay Order', [
        'key' => 'rzp_live_P5HDJtaQPAUv2F',
        'amount' => $amount * 100,
        'currency' => 'INR',
        'receipt' => (string) $transaction->id,
        'app_env' => app()->environment(),
    ]);

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
                'key' => 'rzp_live_P5HDJtaQPAUv2F',
                'amount' => $amount * 100,
                'submission_id' => $submission->id,
                'transaction_id' => $transaction->id,
                'razorpay_order_id' => $order['id'],
                'name' => 'Deities Design Awards',
                'email' => $submission->email,
                'phone' => $submission->phone,
            ]);
        } catch (\Exception $e) {
                Log::error('Razorpay API Initialization Failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
             'trace' => $e->getTraceAsString(),
    ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function razorpayCallback(Request $request)
    {

        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature,
        ];

        try {

            $transaction = DdaTransaction::findOrFail($request->transaction_id);

            $api = new Api(
                env('RAZORPAY_KEY'),
                env('RAZORPAY_SECRET')
            );


            $api->utility->verifyPaymentSignature($attributes);


            $transaction->update([
                'gateway_payment_id' => $attributes['razorpay_payment_id'],
                'gateway_signature' => $attributes['razorpay_signature'],
                'status' => 'Completed',
            ]);

            /* Dispatch invoice */
            PaymentSuccess::dispatch(
                $transaction->dda_id,
                $transaction->id
            );

            return response()->json([
                'success' => true,
            ]);
        } catch (SignatureVerificationError $e) {
            $transaction->update(
                [
                    'gateway_payment_id' => $attributes['razorpay_payment_id'],
                    'gateway_signature' => $attributes['razorpay_signature'],
                    'status' => 'Failed'
                ]
            );

            PaymentFailed::dispatch(
                $transaction->dda_id,
                $transaction->id
            );

            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed.',
            ], 400);
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

    /*
    |--------------------------------------------------------------------------
    | PayPal Client
    |--------------------------------------------------------------------------
    |
    | Builds a PayPalHttpClient configured for whichever mode (sandbox/live)
    | is set in config/paypal.php. Kept private and separate from the
    | Razorpay Api instantiation above so neither gateway can interfere
    | with the other.
    |
    */

    private function paypalClient()
    {
        $mode = config('paypal.mode', 'sandbox');

        $clientId = $mode === 'live'
            ? config('paypal.live.client_id')
            : config('paypal.sandbox.client_id');

        $clientSecret = $mode === 'live'
            ? config('paypal.live.client_secret')
            : config('paypal.sandbox.client_secret');

        $environment = $mode === 'live'
            ? new ProductionEnvironment($clientId, $clientSecret)
            : new SandboxEnvironment($clientId, $clientSecret);

        return new PayPalHttpClient($environment);
    }

    /*
    |--------------------------------------------------------------------------
    | PayPal: Create Order
    |--------------------------------------------------------------------------
    |
    | Mirrors createOrder() above as closely as PayPal's API allows:
    | same submission lookup, same DdaTransaction creation pattern, same
    | transaction_no format, same JSON success/failure envelope shape.
    |
    */

    public function createPaypalOrder(Request $request)
    {
        try {

            $submission = DDA::findOrFail($request->submission_id);

            $amount = config('paypal.entry_fee') ?? config('dda.entry_fee');
            $currency = config('paypal.currency', 'USD');

            /*
            |--------------------------------------------------------------------------
            | Create Transaction
            |--------------------------------------------------------------------------
            */

            $transaction = DdaTransaction::create([
                'dda_id' => $submission->id,
                'gateway' => 'paypal',
                'transaction_no' => 'DDA-' . strtoupper(Str::random(12)),
                'amount' => $amount,
                'currency' => $currency,
                'status' => 'Pending',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Create PayPal Order
            |--------------------------------------------------------------------------
            */
            Log::info('PayPal Config', [
                'mode' => config('paypal.mode'),
            'client_id' => config('paypal.live.client_id'),
            'secret_length' => strlen(config('paypal.live.client_secret') ?? ''),
            ]);

            $client = $this->paypalClient();

            $orderRequest = new OrdersCreateRequest();
            $orderRequest->prefer('return=representation');

            $orderRequest->body = [
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'reference_id' => (string) $transaction->id,
                    'description' => 'Deities Design Awards - Entry Fee',
                    'amount' => [
                        'currency_code' => $currency,
                        'value' => number_format($amount, 2, '.', ''),
                    ],
                ]],
                'application_context' => [
                'brand_name' => config('paypal.brand_name'),
                'landing_page' => 'NO_PREFERENCE',
                'user_action' => 'PAY_NOW',
                'shipping_preference' => 'NO_SHIPPING',
                'return_url' => route('dda.paypal.success'),
                'cancel_url' => route('dda.paypal.cancel'),
                ],
            ];

            $response = $client->execute($orderRequest);
            $order = $response->result;

            /*
            |--------------------------------------------------------------------------
            | Extract Approve URL
            |--------------------------------------------------------------------------
            */

            $approveUrl = null;

            foreach ($order->links as $link) {
                if ($link->rel === 'approve') {
                    $approveUrl = $link->href;
                    break;
                }
            }

            if (! $approveUrl) {
                throw new \Exception('Unable to retrieve PayPal approval URL.');
            }

            /*
            |--------------------------------------------------------------------------
            | Save PayPal Order ID
            |--------------------------------------------------------------------------
            */

            $transaction->update([
                'gateway_order_id' => $order->id,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Return JSON
            |--------------------------------------------------------------------------
            */

            return response()->json([
                'success' => true,
                'approve_url' => $approveUrl,
            ]);
        } catch (HttpException $e) {

            Log::error('PayPal create order failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Unable to create PayPal order.',
            ], 500);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | PayPal: Success (Capture)
    |--------------------------------------------------------------------------
    |
    | PayPal redirects here as ?token={paypal_order_id}&PayerID=... after the
    | buyer approves payment. The token is the same value already saved as
    | gateway_order_id, so the transaction is looked up by that rather than
    | needing a route parameter.
    |
    */

    public function paypalSuccess(Request $request)
    {
        $token = $request->query('token');

        $transaction = DdaTransaction::where('gateway', 'paypal')
            ->where('gateway_order_id', $token)
            ->first();

        if (! $transaction) {
            Log::error('PayPal success callback: no matching transaction for token ' . $token);

            return redirect()->route('dda.payment.failed');
        }

        try {

            $client = $this->paypalClient();

            $captureRequest = new OrdersCaptureRequest($token);
            $captureRequest->prefer('return=representation');

            $response = $client->execute($captureRequest);
            $result = $response->result;

            if ($response->statusCode === 201 && $result->status === 'COMPLETED') {

                $captureId = $result->purchase_units[0]->payments->captures[0]->id ?? null;

                $transaction->update([
                    'gateway_payment_id' => $captureId,
                    'status' => 'Completed',
                ]);

                /* Dispatch invoice */
                PaymentSuccess::dispatch(
                    $transaction->dda_id,
                    $transaction->id
                );

                return redirect()->route('dda.payment.success');
            }

            $transaction->update([
                'status' => 'Failed',
            ]);

            PaymentFailed::dispatch(
                $transaction->dda_id,
                $transaction->id
            );

            return redirect()->route('dda.payment.failed');

        } catch (HttpException $e) {

            Log::error('PayPal capture failed: ' . $e->getMessage());

            $transaction->update([
                'status' => 'Failed',
            ]);

            PaymentFailed::dispatch(
                $transaction->dda_id,
                $transaction->id
            );

            return redirect()->route('dda.payment.failed');

        } catch (\Exception $e) {

            Log::error('PayPal success handling failed: ' . $e->getMessage());

            $transaction->update([
                'status' => 'Failed',
            ]);

            PaymentFailed::dispatch(
                $transaction->dda_id,
                $transaction->id
            );

            return redirect()->route('dda.payment.failed');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | PayPal: Cancel
    |--------------------------------------------------------------------------
    |
    | PayPal redirects here as ?token={paypal_order_id} if the buyer cancels
    | out of the checkout flow before approving.
    |
    */

    public function paypalCancel(Request $request)
    {
        $token = $request->query('token');

        $transaction = DdaTransaction::where('gateway', 'paypal')
            ->where('gateway_order_id', $token)
            ->first();

        if ($transaction) {

            $transaction->update([
                'status' => 'Failed',
            ]);

            PaymentFailed::dispatch(
                $transaction->dda_id,
                $transaction->id
            );
        }

        return redirect()->route('dda.payment.failed');
    }
}