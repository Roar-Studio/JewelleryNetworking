<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Customer, TransactionDetail, Functions, OtpRequest, OtpMaster, MembershipPlan, Event, Coupon, User};
use Illuminate\Support\Facades\{DB, Hash, Auth, Cache, Validator, Response, Mail, Log};
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\{EventRegisteredMail, MembershipAcknowledgementMail};

use Razorpay\Api\Api;

use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;


class CheckoutController extends Controller
{
    public function getCoupons(Request $request)
    {
        $user = Auth::guard('customer-api')->user();

        $request->validate([
            'product_type' => 'required|in:event,membership',
            'product_id' => 'required|string',
        ]);

        $productType = $request->input('product_type');
        $productId = $request->input('product_id');
        $today = Carbon::today();

        $query = Coupon::query()
            ->where('is_active', 1)
            ->where('is_deleted', 0)
            ->where('coupon_type', '<>', 'special')
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today);

        $membershipMap = [
            2 => 'standard',
            3 => 'premium',
        ];

        if ($productType === 'membership') {
            $membershipType = $membershipMap[$productId] ?? null;

            $query->whereIn('coupon_type', ['membership', 'generic', 'special', 'user_specific'])
                ->where(function ($q) use ($membershipType) {
                    $q->whereNull('membership_type');

                    if ($membershipType) {
                        $q->orWhere('membership_type', $membershipType);
                    }
                });
        }
        // if ($productType === 'membership') {
        //     $query->whereIn('coupon_type', ['membership', 'generic', 'user_specific'])
        //         ->where(function ($q) use ($productId) {
        //             $q->whereNull('membership_type')
        //                 ->orWhere('membership_type', $productId);
        //         });
        // } 
        elseif ($productType === 'event') {
            $query->whereIn('coupon_type', ['event', 'generic', 'user_specific'])
                ->where(function ($q) use ($productId) {
                    $q->whereNull('event_type')
                        ->orWhere('event_type', $productId)
                        ->orWhere('event_type', 'all');
                });
        }

        // Filter user_specific coupons if user is authenticated
        if ($user) {
            $query->where(function ($q) use ($user) {
                $q->where('coupon_type', '<>', 'user_specific') // Include all non-user_specific
                ->orWhereJsonContains('user_specific', (string) $user->id); // OR user_specific contains user id
            });
        } else {
            // If user is not authenticated, exclude user_specific
            $query->where('coupon_type', '<>', 'user_specific');
        }
        

        $coupons = $query->get();

        if ($coupons->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No applicable coupons found.'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'Coupons listed.',
            'data' => $coupons
        ]);
    }

    public function getCouponById(Request $request)
    {
        $user = Auth::guard('customer-api')->user();

        $request->validate([
            'product_type' => 'required|in:event,membership',
            'product_id' => 'required|string',
            'coupon_code' => 'required'
        ]);

        $productType = $request->input('product_type');
        $productId = $request->input('product_id');
        $today = Carbon::today();

        $query = Coupon::query()
            ->where('coupon_code', $request->coupon_code)
            ->where('is_active', 1)
            ->where('is_deleted', 0)
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today);

        // Filter by event_type or membership_type
        $membershipMap = [
            2 => 'standard',
            3 => 'premium',
        ];

        if ($productType === 'membership') {
            $membershipType = $membershipMap[$productId] ?? null;

            $query->whereIn('coupon_type', ['membership', 'generic', 'special', 'user_specific'])
                ->where(function ($q) use ($membershipType) {
                    $q->whereNull('membership_type');

                    if ($membershipType) {
                        $q->orWhere('membership_type', $membershipType);
                    }
                });
        }
        // if ($productType === 'membership') {
        //     $query->whereIn('coupon_type', ['membership', 'generic', 'special', 'user_specific'])
        //         ->where(function ($q) use ($productId, $user) {
        //             $q->whereNull('membership_type')
        //                 ->orWhere('membership_type', $productId);
        //         });
        // } 
        elseif ($productType === 'event') {
            $query->whereIn('coupon_type', ['event', 'generic', 'special', 'user_specific'])
                ->where(function ($q) use ($productId) {
                    $q->whereNull('event_type')
                        ->orWhere('event_type', $productId)
                        ->orWhere('event_type', 'all');
                });
        }

        // Handle user-specific coupon logic
        if ($user) {
            $query->where(function ($q) use ($user) {
                $q->where('coupon_type', '<>', 'user_specific')
                ->orWhereJsonContains('user_specific', (string) $user->id);
            });
        } else {
            $query->where('coupon_type', '<>', 'user_specific');
        }

        $coupon = $query->first();

        if ($coupon) {
            $product = null;
            switch ($productType) {
                case 'event':
                    $product = Event::find($productId);
                    break;
                case 'membership':
                    $product = MembershipPlan::find($productId);
                    break;
            }
            
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => ucwords($productType).' not found.'
                ], 404);
            }
            $isINR = $request->selectedCurrencyCode === 'INR';
            $product_price = (float) ($isINR ? $product->amount_in_inr : $product->amount_in_usd);
            if ($coupon->discount_type === 'flat') {
                $coupon_minimum_price_limit = (float) ($isINR ? $coupon->minimum_purchase_inr : $coupon->minimum_purchase_usd);
                

                if ($product_price < $coupon_minimum_price_limit) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid Coupon. Minimum purchase amount not met.'
                    ], 400);
                }
            }

            $transactionCount = TransactionDetail::where('coupon_id', $coupon->id)
                ->where('status', 'completed')
                ->count();

            if ($transactionCount >= $coupon->max_use_per_user && $coupon->coupon_type === 'special') {
                return response()->json([
                    'success' => false,
                    'message' => 'This coupon has reached its usage limit and is no longer available.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Coupon is available for use.',
                'data' => $coupon
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No applicable coupons found.'
            ], 404);
        }
    }


    public function getCheckoutData(Request $request)
    {
        $user = Auth::guard('customer-api')->user();
        $productType = $request->product_type;
        $productId = $request->product_id;
        $today = Carbon::today();

        if (!$productType || !$productId) {
            return response()->json(['status' => false, 'error' => 'Invalid request'], 400);
        }

        if ($productType === 'event') {
            $product = Event::withCount(['transactions as completed_transaction_count' => function ($query) {
                $query->where('status', 'completed');
            }])
            ->where('id', $productId)
            ->where('is_active', 1)
            ->where('is_deleted', 0)
            ->where('display_start_date', '<=', $today)
            ->where('display_end_date', '>=', $today)
            ->first();
            // dd($product);
            if (!$product || $product->completed_transaction_count >= $product->total_seats) {
                return response()->json(['status' => false, 'message' => 'Event not Found or Not Available now'], 404);
            }

            $product->image = $product->banner ? asset('storage/'.$product->banner) : asset('/new_ui/assets/images/jn-logo.webp');
           
            $price = $request->selectedCurrencyCode == 'INR' ? (float)$product->amount_in_inr : (float)$product->amount_in_usd;
            
        } elseif ($productType === 'membership') {
            //$user = Auth::guard('customer-api')->user();
            $product = MembershipPlan::where('is_active', 1)->where('id', '<>', 1)->where('id', $productId)->first();
            if($product){
                $product->name = $product->name . ' Membership';
                $product->image = asset('/new_ui/assets/images/jn-logo.webp');
            }
            else{
                return response()->json(['status' => false, 'message' => 'Membership not Found'], 400);
            }
            $currency = $request->selectedCurrencyCode == 'INR' ? 'INR' : 'USD';
            $productAmount = $currency === 'INR' ? (float)$product->amount_in_inr : (float)$product->amount_in_usd;

            $userPlanType = (int) $user?->plan_type;
            $product->id = (int) $product->id;

            $price = 0;
            
            if ($userPlanType == 1) {
                // New user, no previous plan: full price
                $price = $productAmount;
            } elseif ($userPlanType < $product->id ) {
                // Upgrade from plan 2 to plan 3
                $userPlan = MembershipPlan::find($userPlanType);
                $oldAmount = $currency === 'INR' ? (float)$userPlan->amount_in_inr : (float)$userPlan->amount_in_usd;
                $price = $productAmount - $oldAmount;
            } elseif ($userPlanType === $product->id) {
                // Re-purchase same plan: full price
                $price = $productAmount;
            } elseif ($userPlanType === 3 && $product->id === 2) {
                // Disallow downgrade
                return response()->json(['message' => 'You cannot downgrade your current plan.'], 400);
            } else {
                // Catch any unexpected downgrade
                return response()->json(['message' => 'Invalid plan selection.'], 400);
            }
        } else {
            return response()->json(['status' => false, 'error' => 'Unsupported product type'], 400);
        }

        if (!$product) {
            return response()->json(['status' => false, 'error' => 'Product not found'], 404);
        }

        $coupon_amount = 0;
        if ($request->couponId) {
            $coupon = Coupon::where('is_active', 1)
                ->where('is_deleted', 0)
                ->whereDate('start_date', '<=', $today)
                ->whereDate('end_date', '>=', $today)
                ->where('id', $request->couponId)
                ->first();

            if ($coupon) {
                if ($coupon->discount_type === 'flat') {
                    $coupon_minimum_price_limit = (float) ($request->selectedCurrencyCode == 'INR' ? $coupon->minimum_purchase_inr : $coupon->minimum_purchase_usd);
                    if ($price < $coupon_minimum_price_limit) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Invalid Coupon. Minimum purchase amount not met.'
                        ], 400);
                    }
                    $coupon_amount = $request->selectedCurrencyCode == 'INR' ? $coupon->discount_flat_inr : $coupon->discount_flat_usd;
                } else if ($coupon->discount_type === 'percent') {
                    $coupon_amount = $request->selectedCurrencyCode == 'INR' ? ($price * ($coupon->discount_percent_inr / 100)) : ($price * ($coupon->discount_percent_usd / 100));
                    if ($request->selectedCurrencyCode == 'INR' && $coupon->maximum_discount_inr && $coupon_amount > $coupon->maximum_discount_inr) {
                        $coupon_amount = $coupon->maximum_discount_inr;
                    } elseif ($request->selectedCurrencyCode == 'USD' && $coupon->maximum_discount_usd && $coupon_amount > $coupon->maximum_discount_usd) {
                        $coupon_amount = $coupon->maximum_discount_usd;
                    }
                }
            }
        }

        if ($productType == 'membership') {
            // Price is GST-included already
            $discounted_price = max(0, $price - $coupon_amount);

            // Extract GST from discounted price (since it's included)
            $price_without_gst = $discounted_price / 1.18;
            $gst = $discounted_price - $price_without_gst;
            $total = $discounted_price;
            $price = $price_without_gst;
        } else {
            // Regular flow where price is exclusive of GST
            $discounted_price = max(0, $price - $coupon_amount);
            $gst = $discounted_price * 0.18;
            $total = $discounted_price + $gst;
        }


        $checkout_data = [
            'product_name' => $product->name,
            'product_image' => $product->image ?? asset('images/default.jpg'),
            'product_price' => number_format($price, 2),
            'subtotal' => number_format($price, 2),
            'gst' => number_format($gst, 2),
            'coupon' => number_format($coupon_amount, 2),
            'total' => number_format($total,2),
            'userid' => $user?->id,
            'company_name' => $user?->company_name,
            'company_address' => $user?->company_address,
            'trn_no' => $user?->trn_no
        ];

        return response()->json(['status' => true, 'error' => 'Data fetched', 'data' => $checkout_data], 200);
    }
    
    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'product_type' => 'required|in:membership,event',
            'product_id' => 'required|integer',
            'payment_method' => 'nullable|in:razorpay,paypal',
            'coupon_id' => 'nullable|string',
        ]);
        $user = Auth::guard('customer-api')->user();
        
        $type = $validated['product_type'];
        $id = $validated['product_id'];

        $item = $type === 'membership'
            ? MembershipPlan::where('id', $id)
                ->where('id', '<>', 1)
                ->where('id', '>=',  $user->plan_type)
                ->where('is_active', 1)
                ->firstOrFail()
            : Event::where('id', $id)
                ->where('is_active', 1)
                ->where('is_deleted', 0)
                ->firstOrFail();

        $selectedCurrencyCode = $request->selectedCurrencyCode ?? 'INR';
        if($type === 'membership'){
            $user = Auth::guard('customer-api')->user();
            $product = MembershipPlan::where('is_active', 1)->where('id', '<>', 1)->where('id', $id)->first();
            if(!$product){
                return response()->json(['status' => false, 'message' => 'Membership not Found'], 400);
            }
            $currency = $request->selectedCurrencyCode == 'INR' ? 'INR' : 'USD';
            $productAmount = $currency === 'INR' ? (float)$product->amount_in_inr : (float)$product->amount_in_usd;
            
            $price = 0;
            
            if ($user->plan_type == 1) {
                // New user, no previous plan: full price
                $price = $productAmount;
            } elseif ($user->plan_type < $product->id ) {
                // Upgrade from plan 2 to plan 3
                $userPlan = MembershipPlan::find($user->plan_type);
                $oldAmount = $currency == 'INR' ? (float)$userPlan->amount_in_inr : (float)$userPlan->amount_in_usd;
                $price = $productAmount - $oldAmount;
            } elseif ($user->plan_type == $product->id) {
                // Re-purchase same plan: full price
                $price = $productAmount;
            } elseif ($user->plan_type == 3 && $product->id == 2) {
                // Disallow downgrade
                return response()->json(['message' => 'You cannot downgrade your current plan.'], 400);
            } else {
                // Catch any unexpected downgrade
                return response()->json(['message' => 'Invalid plan selection.'], 400);
            }
        }
        else{
            $price = $selectedCurrencyCode === 'INR' ? (float)$item->amount_in_inr : (float)$item->amount_in_usd;
        }

        $coupon_amount = 0;
        if ($request->coupon_id) {
            $coupon = Coupon::find($request->coupon_id);
            if ($coupon) {
                if ($coupon->discount_type === 'flat') {
                    $coupon_minimum_price_limit = (float) ($request->selectedCurrencyCode == 'INR' ? $coupon->minimum_purchase_inr : $coupon->minimum_purchase_usd);
                
                    if ($price < $coupon_minimum_price_limit) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Invalid Coupon. Minimum purchase amount not met.'
                        ], 400);
                    }
                    $coupon_amount = $selectedCurrencyCode === 'INR' ? $coupon->discount_flat_inr : $coupon->discount_flat_usd;
                } elseif ($coupon->discount_type === 'percent') {
                    $coupon_amount = $selectedCurrencyCode === 'INR' 
                        ? ($price * ($coupon->discount_percent_inr / 100)) 
                        : ($price * ($coupon->discount_percent_usd / 100));

                    if ($selectedCurrencyCode === 'INR' && $coupon->maximum_discount_inr && $coupon_amount > $coupon->maximum_discount_inr) {
                        $coupon_amount = $coupon->maximum_discount_inr;
                    } elseif ($selectedCurrencyCode === 'USD' && $coupon->maximum_discount_usd && $coupon_amount > $coupon->maximum_discount_usd) {
                        $coupon_amount = $coupon->maximum_discount_usd;
                    }
                }
            }
        }

        if ($type == 'membership') {
            // Price is GST-included already
            $discounted_price = max(0, $price - $coupon_amount);

            // Extract GST from discounted price (since it's included)
            $price_without_gst = $discounted_price / 1.18;
            $gst = $discounted_price - $price_without_gst;
            $total = round($discounted_price, 2);
            $price = $price_without_gst;
        } else {
            // Regular flow where price is exclusive of GST
            $discounted_price = max(0, $price - $coupon_amount);
            $gst = $discounted_price * 0.18;
            $total = round($discounted_price + $gst, 2);
        }


        $order_id = 'ORD-' . strtoupper(Str::random(10));

        $txn = TransactionDetail::create([
            'transaction_id' => null,
            'order_id' => $order_id,
            'customer_id' => $user ? $user->id : null,
            'transactionable_type' => get_class($item),
            'transactionable_id' => $item->id,
            'currency_type' => $selectedCurrencyCode,
            'price' => $price,
            'gst' => $gst,
            'discount' => $coupon_amount,
            'coupon_id' => $request->coupon_id,
            'total_amount' => $total,
            'payer_first_name' => $request->first_name,
            'payer_last_name' => $request->last_name,
            'payer_mobile_no' => $request->mobile_no,
            'payer_mobile_no_cc' => $request->mobile_no_cc,
            'payer_mobile_no_ic' => $request->mobile_no_ic,
            'payer_email' => $request->email,
            'payer_taxid' => $request->tax_id,
            'payer_company_name' => $request->company_name,
            'payer_company_address' => $request->company_address,
            'status' => $total == 0 ? 'completed' : 'pending',
            'payment_method' => $total == 0 ? 'free' : $validated['payment_method'],
            'currency_type' => $request->selectedCurrencyCode,
            'transaction_reference' => null,
            'transaction_date' => now(),
        ]);

        if ($user) {
            \DB::table('customers')
                ->where('id', $user->id)
                ->update([
                    'trn_no' => $request->tax_id,
                    'company_name' => $request->company_name,
                    'company_address' => $request->company_address,
                ]);
        }
        
        if ($total == 0) {
            if ($txn->transactionable_type === \App\Models\Event::class) {
                $event = $txn->transactionable;

                //Generate Membership ID
                $customer = Customer::find($txn->customer_id);
                $prefix = match ((int)$customer?->plan_type ?? 0) {
                    1 => 'F',
                    2 => 'S',
                    3 => 'P',
                    default => 'X',
                };

                if ($prefix != 'X') {
                    $membershipId = $prefix . str_pad($customer->id, 6, '0', STR_PAD_LEFT);
                } else {
                    $membershipId = '';
                }
                
                Mail::to($txn->payer_email)->cc(['shashikala.kushwaha@vervali.com'])->send(new EventRegisteredMail(
                    $txn->payer_first_name.' '.$txn->payer_last_name,
                    $event->name,
                    $event->venue_address,
                    $event->google_meet_link,
                    Carbon::parse($event->event_start_datetime)->format('D, d M Y h:i A'),
                    $txn->order_id,
                    $membershipId
                ));
            }elseif ($txn->transactionable_type === \App\Models\MembershipPlan::class) {
                $membershipPlan = $txn->transactionable;
    
                Mail::to($txn->payer_email)->send(new MembershipAcknowledgementMail(
                    $txn->payer_first_name.' '.$txn->payer_last_name,
                    Carbon::parse($txn->expire_date)->format('Y-m-d'), 
                    $membershipPlan->name, 
                    $membershipPlan->benefits, 
                    $txn->order_id
                ));
            }
            return response()->json([
                'success' => true,
                'redirect' => route('order.confirmation', ['order_id' => $order_id])
            ]);
        }
        if($validated['payment_method'] == 'razorpay'){
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    
            $order = $api->order->create([
                'receipt'  => (string) $txn->id,           // Receipt must be a string
                'amount'   => (string) ($total * 100),     // Amount in paise as string
                'currency' => 'INR',
                'payment_capture' => 1
            ]);
            $order_id = $order['id'];
        }

        return response()->json([
            'success' => true,
            'gateway' => $validated['payment_method'],
            'amount' => round($total, 2),
            'order_id' => $order_id,
            'txn_id' => $txn->id,
            'txn_order_id' => $txn->order_id,
        ]);
    }
    public function extraCodeForCaptureRazorpayPayments(){
        // $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        // try {
        //     // 1. Verify Razorpay signature
        //     $attributes = [
        //         'razorpay_order_id'   => $request->razorpay_order_id,
        //         'razorpay_payment_id' => $request->razorpay_payment_id,
        //         'razorpay_signature'  => $request->razorpay_signature
        //     ];
        //     $api->utility->verifyPaymentSignature($attributes);

        //     // 2. Capture the payment (amount in paise)
        //     $payment = $api->payment->fetch($request->razorpay_payment_id);
        //     $payment->capture(['amount' => $payment['amount']]); // Auto captures

        // } catch (\Exception $e) {
        //     Log::error("Razorpay verification failed: " . $e->getMessage());
        //     return response()->json(['message' => 'Payment verification failed.'], 400);
        // }
    }
    public function razorpayCallback(Request $request)
    {
        $txn = TransactionDetail::findOrFail($request->txn_id);
        $txn->update([
            'status' => 'completed',
            'payment_method' => 'razorpay',
            'transaction_reference' => $request->razorpay_payment_id,
            'transaction_id' => $request->razorpay_payment_id,
            'transaction_date' => now(),
        ]);

        if($txn->transactionable_type === \App\Models\Event::class) {
            $event = $txn->transactionable;
            // dd($event);

            //Generate Membership ID
            $customer = Customer::find($txn->customer_id);
            $prefix = match ((int)$customer->plan_type) {
                1 => 'F',
                2 => 'S',
                3 => 'P',
                default => 'X',
            };

            if ($prefix != 'X') {
                $membershipId = $prefix . str_pad($customer->id, 6, '0', STR_PAD_LEFT);
            } else {
                $membershipId = '';
            }
            
            Mail::to($txn->payer_email)->send(new EventRegisteredMail(
                $txn->payer_first_name.' '.$txn->payer_last_name,
                $event->name,
                $event->venue_address,
                $event->google_meet_link,
                Carbon::parse($event->event_start_datetime)->format('D, d M Y h:i A'),
                $txn->order_id,
                $membershipId
            ));
        }

        if ($txn->transactionable_type === \App\Models\MembershipPlan::class) {
            $membershipPlan = $txn->transactionable;
            
            // Optional: Get plan name based on ID (you can also use $membershipPlan->name if present)
            $planName = match ($membershipPlan->id) {
                2 => 'Standard',
                3 => 'Premium',
                default => 'Unknown Plan'
            };

            $customer = Customer::find($txn->customer_id); // Assuming you have this relationship set
            
            $startDate = null;
            $expireDate = null; 
            
            if ($customer->plan_type == 1) {
                // New user, no previous plan
                $startDate = Carbon::now()->format('Y-m-d');
                $expireDate = Carbon::now()->addYear()->format('Y-m-d');
                $note = "Membership upgraded to {$planName}";

            } elseif ($customer->plan_type < $membershipPlan->id) {
                // Upgrade case
                $planStartedAt = $customer->plan_started_at ? Carbon::parse($customer->plan_started_at) : null;
                $planExpiredAt = $customer->plan_expired_at ? Carbon::parse($customer->plan_expired_at) : null;

                $startDate = $planStartedAt->format('Y-m-d');
                if ($planExpiredAt && Carbon::now()->diffInMonths($planExpiredAt, false) <= 3) {
                    $expireDate = $planExpiredAt->addMonth()->format('Y-m-d');
                } else {
                    $expireDate = $planExpiredAt->format('Y-m-d');
                }
                $note = "Membership upgraded to {$planName}";

            } elseif ($customer->plan_type == $membershipPlan->id) {
                
                $planExpiredAt = $customer->plan_expired_at ? Carbon::parse($customer->plan_expired_at) : Carbon::now();
                $startDate = $planExpiredAt->copy()->addDay()->format('Y-m-d');
                $expireDate = $planExpiredAt->copy()->addDay()->addYear()->format('Y-m-d');

                $note = "Membership renewed for {$planName}";

            } elseif ($customer->plan_type > $membershipPlan->id) {
                return response()->json(['message' => 'You cannot downgrade your current plan.'], 400);
            } else {
                // Catch any unexpected downgrade
                return response()->json(['message' => 'Invalid plan selection.'], 400);
            }
            
            // Update the transaction note
            $txn->update([
                'start_date' => $startDate,
                'expire_Date' => $expireDate,
                'note' => $note
            ]);
            
            // Update customer details
            if($customer){
                $customer->plan_type = $membershipPlan->id;
                // Only update plan_started_at if startDate is today or earlier
                if (Carbon::parse($startDate)->lte(Carbon::today())) {
                    $customer->plan_started_at = $startDate;
                }
                $customer->plan_expired_at = $expireDate;
                $customer->save();

                Mail::to($customer->email)->send(new MembershipAcknowledgementMail(
                    $customer->first_name.' '.$customer->last_name,
                    Carbon::parse($expireDate)->format('Y-m-d'), 
                    $membershipPlan->name, 
                    $membershipPlan->benefits, 
                    $txn->order_id
                ));
            }
        }
        return response()->json(['redirect' => route('order.confirmation', ['order_id' => $txn->order_id])]);
    }

    public function paypalCheckout($order_id)
    {
        // Fetch transaction details
        $txn = TransactionDetail::where('order_id', $order_id)->firstOrFail();

        // Ensure transaction is still pending
        if ($txn->status !== 'pending') {
            return redirect()->route('order.confirmation', ['order_id' => $order_id])
                            ->with('message', 'Order already processed.');
        }

        // PayPal API Credentials
        $clientId = env('PAYPAL_CLIENT_ID');
        $clientSecret = env('PAYPAL_SECRET');
        $paypalMode = env('PAYPAL_MODE', 'sandbox');

        // Setup PayPal environment
        if ($paypalMode === 'live') {
            $environment = new ProductionEnvironment($clientId, $clientSecret);
        } else {
            $environment = new SandboxEnvironment($clientId, $clientSecret);
        }
        $client = new PayPalHttpClient($environment);

        // Create PayPal order
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "amount" => [
                    "currency_code" => "USD",
                    "value" => $txn->total_amount
                ]
            ]],
            "application_context" => [
                "cancel_url" => route('paypal.cancel', ['order_id' => $order_id]),
                "return_url" => route('paypal.success', ['order_id' => $order_id])
            ]
        ];

        try {
            $response = $client->execute($request);
            $order = $response->result;

            // Find the approval link dynamically
            $approvalUrl = null;
            foreach ($order->links as $link) {
                if ($link->rel === 'approve') {
                    $approvalUrl = $link->href;
                    break;
                }
            }

            if ($approvalUrl) {
                return redirect()->away($approvalUrl);
            } else {
                return back()->with('error', 'PayPal approval link not found.');
            }
        } catch (\Exception $e) {
            Log::error('PayPal Error: ' . $e->getMessage());
            return back()->with('error', 'PayPal Error: ' . $e->getMessage());
        }
    }
    public function paypalSuccess(Request $request, $order_id)
    {
        $txn = TransactionDetail::where('order_id', $order_id)->firstOrFail();

        if ($txn->status === 'completed') {
            Log::warning("Duplicate PayPal success callback ignored for Order ID: {$order_id}");
            return redirect()->route('order.confirmation', ['order_id' => $order_id]);
        }
        $clientId = env('PAYPAL_CLIENT_ID');
        $clientSecret = env('PAYPAL_SECRET');
        $paypalMode = env('PAYPAL_MODE', 'sandbox');
        
        if ($paypalMode === 'live') {
            $environment = new ProductionEnvironment($clientId, $clientSecret);
        } else {
            $environment = new SandboxEnvironment($clientId, $clientSecret);
        }

        $client = new PayPalHttpClient($environment);

        try {
            // 1. Get PayPal Order Details
            $orderDetailsRequest = new OrdersGetRequest($request->token);
            $orderDetailsResponse = $client->execute($orderDetailsRequest);
            $orderDetails = $orderDetailsResponse->result;
            
            // 2. Capture payment if approved
            if ($orderDetails->status === 'APPROVED') {
                $requestCapture = new OrdersCaptureRequest($request->token);
                $captureResponse = $client->execute($requestCapture);
                $order = $captureResponse->result;
            } else {
                $order = $orderDetails;
            }
            
            if ($order->status === 'COMPLETED') {
                $txn = TransactionDetail::where('order_id', $order_id)->firstOrFail();

                if ($txn->status === 'completed') {
                    Log::warning("Duplicate PayPal success callback ignored for Order ID: {$order_id}");
                    return redirect()->route('order.confirmation', ['order_id' => $order_id]);
                }
                DB::beginTransaction();

                $txn->update([
                    'status' => 'completed',
                    'transaction_reference' => $order->id,
                    'transaction_id' => $order->id,
                    'transaction_date' => now()
                ]);

                if ($txn->transactionable_type === \App\Models\MembershipPlan::class) {
                    $membershipPlan = $txn->transactionable;
                    $customer = Customer::find($txn->customer_id);
                    $planName = match ($membershipPlan->id) {
                        2 => 'Standard',
                        3 => 'Premium',
                        default => 'Unknown Plan'
                    };

                    $startDate = null;
                    $expireDate = null;
                    $note = "";

                    // Handle date fields safely
                    $planStartedAt = $customer->plan_started_at ? Carbon::parse($customer->plan_started_at) : Carbon::now();
                    $planExpiredAt = $customer->plan_expired_at ? Carbon::parse($customer->plan_expired_at) : Carbon::now();

                    if ($customer->plan_type == 1) {
                        $startDate = Carbon::now()->format('Y-m-d');
                        $expireDate = Carbon::now()->addYear()->format('Y-m-d');
                        $note = "Membership upgraded to {$planName}";
                    } elseif ($customer->plan_type < $membershipPlan->id) {
                        $note = "Membership upgraded to {$planName}";

                        if ($planExpiredAt && Carbon::now()->lt($planExpiredAt) && Carbon::now()->diffInMonths($planExpiredAt) <= 3) {
                            $expireDate = $planExpiredAt->copy()->addMonth()->format('Y-m-d');
                            $note = "Membership renewed for {$planName}";
                        } else {
                            $expireDate = $planExpiredAt->format('Y-m-d');
                        }

                        $startDate = $planStartedAt->format('Y-m-d');
                    } elseif ($customer->plan_type == $membershipPlan->id) {
                        $planExpiredAt = $customer->plan_expired_at ? Carbon::parse($customer->plan_expired_at) : Carbon::now();
                        $startDate = $planExpiredAt->copy()->addDay()->format('Y-m-d');
                        $expireDate = $planExpiredAt->copy()->addDay()->addYear()->format('Y-m-d');
                        $note = "Membership renewed for {$planName}";
                    } elseif ($customer->plan_type > $membershipPlan->id) {
                        Log::warning("Downgrade attempt blocked: Customer #{$customer->id} tried to downgrade from plan {$customer->plan_type} to {$membershipPlan->id}");
                        DB::rollBack();
                        return response()->json(['message' => 'You cannot downgrade your current plan.'], 400);
                    } else {
                        DB::rollBack();
                        return response()->json(['message' => 'Invalid plan selection.'], 400);
                    }

                    $txn->update([
                        'start_date' => $startDate,
                        'expire_Date' => $expireDate,
                        'note' => $note
                    ]);

                    if ($customer) {
                        $customer->plan_type = $membershipPlan->id;
                        if (Carbon::parse($startDate)->lte(Carbon::today())) {
                            $customer->plan_started_at = $startDate;
                        }
                        $customer->plan_expired_at = $expireDate;
                        $customer->save();

                        Mail::to($customer->email)->send(new MembershipAcknowledgementMail(
                            $customer->first_name . ' ' . $customer->last_name,
                            Carbon::parse($expireDate)->format('Y-m-d'),
                            $membershipPlan->name,
                            $membershipPlan->benefits,
                            $txn->order_id
                        ));
                    }
                } elseif ($txn->transactionable_type === \App\Models\Event::class) {
                    $event = $txn->transactionable;

                    //Generate Membership ID
                    $customer = Customer::find($txn->customer_id);
                    $prefix = match ((int)$customer->plan_type) {
                        1 => 'F',
                        2 => 'S',
                        3 => 'P',
                        default => 'X',
                    };

                    if ($prefix != 'X') {
                        $membershipId = $prefix . str_pad($customer->id, 6, '0', STR_PAD_LEFT);
                    } else {
                        $membershipId = '';
                    }

                    Mail::to($txn->payer_email)->send(new EventRegisteredMail(
                        $txn->payer_first_name . ' ' . $txn->payer_last_name,
                        $event->name,
                        $event->venue_address,
                        $event->google_meet_link,
                        Carbon::parse($event->event_start_datetime)->format('D, d M Y h:i A'),
                        $txn->order_id,
                        $membershipId
                    ));
                }

                DB::commit();
                return redirect()->route('order.confirmation', ['order_id' => $order_id]);
            } else {
                $txn->update(['status' => 'failed']);
                Log::error("PayPal payment not completed. Status: {$order->status}");
                return redirect()->route('paypal.cancel', ['order_id' => $order_id])
                    ->with('error', 'Your payment could not be completed. Please contact support if you were charged.');
            }

        } catch (\PayPalHttp\HttpException $e) {
            DB::rollBack();
            Log::error('PayPal HTTP Exception', [
                'message' => $e->getMessage(),
                'status_code' => $e->statusCode,
                'headers' => $e->headers,
                'response' => $e->getMessage()
            ]);
            $txn->update(['status' => 'failed']);
            return redirect()->route('paypal.cancel', ['order_id' => $order_id])
                ->with('error', 'A PayPal error occurred while processing your payment. Please try again.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('PayPal General Error: ' . $e->getMessage());
            $txn->update(['status' => 'failed']);
            return redirect()->route('paypal.cancel', ['order_id' => $order_id])
                ->with('error', 'Something went wrong while completing your payment. Please contact support if you were charged.');
        }
    }

    // public function paypalSuccessOld(Request $request, $order_id)
    // {
    //     $txn = TransactionDetail::where('order_id', $order_id)->firstOrFail();

    //     // // Prevent duplicate processing
    //     // if ($txn->status === 'completed') {
    //     //     return redirect()->route('order.confirmation', ['order_id' => $order_id]);
    //     // }
        
    //     $clientId = env('PAYPAL_CLIENT_ID');
    //     $clientSecret = env('PAYPAL_SECRET');
    //     $paypalMode = env('PAYPAL_MODE', 'sandbox');
        
    //     if ($paypalMode === 'live') {
    //         $environment = new ProductionEnvironment($clientId, $clientSecret);
    //     } else {
    //         $environment = new SandboxEnvironment($clientId, $clientSecret);
    //     }
    //     $client = new PayPalHttpClient($environment);

    //     try {
    //         // 1. Get PayPal Order Details
    //         $orderDetailsRequest = new OrdersGetRequest($request->token);
    //         $orderDetailsResponse = $client->execute($orderDetailsRequest);
    //         $orderDetails = $orderDetailsResponse->result;

    //         // 2. If not completed, capture payment
    //         if ($orderDetails->status === 'APPROVED') {
    //             $requestCapture = new OrdersCaptureRequest($request->token);
    //             $captureResponse = $client->execute($requestCapture);
    //             $order = $captureResponse->result;
    //         } else {
    //             $order = $orderDetails; // Already captured or in unexpected state
    //         }

    //         if ($order->status === 'COMPLETED') {
    //             $txn->update([
    //                 'status' => 'completed',
    //                 'transaction_reference' => $order->id,
    //                 'transaction_id' => $order->id,
    //                 'transaction_date' => now()
    //             ]);

    //             if ($txn->transactionable_type === \App\Models\MembershipPlan::class) {
    //                 $membershipPlan = $txn->transactionable;
    //                 $customer = Customer::find($txn->customer_id);
    //                 $planName = match ($membershipPlan->id) {
    //                     2 => 'Standard',
    //                     3 => 'Premium',
    //                     default => 'Unknown Plan'
    //                 };

    //                 $startDate = null;
    //                 $expireDate = null;
    //                 $note = "";

    //                 if ($customer->plan_type == 1) {
    //                     $startDate = Carbon::now()->format('Y-m-d');
    //                     $expireDate = Carbon::now()->addYear()->format('Y-m-d');
    //                     $note = "Membership upgraded to {$planName}";
    //                 } elseif ($customer->plan_type < $membershipPlan->id) {
    //                     $planStartedAt = $customer->plan_started_at ? Carbon::parse($customer->plan_started_at) : null;
    //                     $planExpiredAt = $customer->plan_expired_at ? Carbon::parse($customer->plan_expired_at) : null;
    //                     $note = "Membership upgraded to {$planName}";

    //                     $startDate = $planStartedAt->format('Y-m-d');
    //                     if ($planExpiredAt && Carbon::now()->diffInMonths($planExpiredAt, false) <= 3) {
    //                         $expireDate = $planExpiredAt->addMonth()->format('Y-m-d');
    //                         $note = "Membership renewed for {$planName}";
    //                     } else {
    //                         $expireDate = $planExpiredAt->format('Y-m-d');
    //                     }
    //                 } elseif ($customer->plan_type == $membershipPlan->id) {
    //                     $planExpiredAt = $customer->plan_expired_at ? Carbon::parse($customer->plan_expired_at) : Carbon::now();
    //                     $startDate = $planExpiredAt->copy()->addDay()->format('Y-m-d');
    //                     $expireDate = $planExpiredAt->copy()->addDay()->addYear()->format('Y-m-d');
    //                     $note = "Membership renewed for {$planName}";
    //                 } elseif ($customer->plan_type > $membershipPlan->id) {
    //                     return response()->json(['message' => 'You cannot downgrade your current plan.'], 400);
    //                 } else {
    //                     return response()->json(['message' => 'Invalid plan selection.'], 400);
    //                 }

    //                 $txn->update([
    //                     'start_date' => $startDate,
    //                     'expire_Date' => $expireDate,
    //                     'note' => $note
    //                 ]);

    //                 if ($customer) {
    //                     $customer->plan_type = $membershipPlan->id;
    //                     if (Carbon::parse($startDate)->lte(Carbon::today())) {
    //                         $customer->plan_started_at = $startDate;
    //                     }
    //                     $customer->plan_expired_at = $expireDate;
    //                     $customer->save();

    //                     Mail::to($customer->email)->send(new MembershipAcknowledgementMail(
    //                         $customer->first_name . ' ' . $customer->last_name,
    //                         Carbon::parse($expireDate)->format('Y-m-d'),
    //                         $membershipPlan->name,
    //                         $membershipPlan->benefits,
    //                         $txn->order_id
    //                     ));
    //                 }
    //             } elseif ($txn->transactionable_type === \App\Models\Event::class) {
    //                 $event = $txn->transactionable;
    //                 Mail::to($txn->payer_email)->send(new EventRegisteredMail(
    //                     $txn->payer_first_name . ' ' . $txn->payer_last_name,
    //                     $event->name,
    //                     $event->venue_address,
    //                     Carbon::parse($event->event_start_datetime)->format('D, d M Y h:i A'),
    //                     $txn->order_id
    //                 ));
    //             }

    //             return redirect()->route('order.confirmation', ['order_id' => $order_id]);
    //         } else {
    //             $txn->update(['status' => 'failed']);
    //             Log::error("PayPal payment not completed. Status: {$order->status}");
    //             return redirect()->route('paypal.success', ['order_id' => $order_id])
    //                 ->with('error', 'Payment could not be completed.');
    //         }

    //     } catch (\PayPalHttp\HttpException $e) {
    //         Log::error('PayPal HTTP Exception', [
    //             'message' => $e->getMessage(),
    //             'status_code' => $e->statusCode,
    //             'headers' => $e->headers,
    //             'response' => $e->getMessage()
    //         ]);
    //         $txn->update(['status' => 'failed']);
    //         return redirect()->route('paypal.success', ['order_id' => $order_id])
    //             ->with('error', 'PayPal Error: ' . $e->getMessage());
    //     } catch (\Exception $e) {
    //         Log::error('PayPal General Error: ' . $e->getMessage());
    //         $txn->update(['status' => 'failed']);
    //         return redirect()->route('paypal.success', ['order_id' => $order_id])
    //             ->with('error', 'Payment Failed: ' . $e->getMessage());
    //     }
    // }

    public function paypalCancel($order_id)
    {
        $txn = TransactionDetail::where('order_id', $order_id)->firstOrFail();
        
        $txn = TransactionDetail::with('transactionable')->where('order_id', $order_id)->firstOrFail();
        $txn->update(['status' => 'failed']);
        // dd($txn);
        if($txn->transactionable instanceof \App\Models\MembershipPlan){
            $txn->product_name = $txn->transactionable->name . ' Membership';
            $txn->product_image = asset('/new_ui/assets/images/jn-logo.webp');
        }
        elseif($txn->transactionable instanceof \App\Models\Event){
            $txn->product_name = $txn->transactionable->name;
            $txn->product_image = $txn->transactionable->banner ? asset('storage/'.$txn->transactionable->banner) : asset('/new_ui/assets/images/jn-logo.webp');
        }
        
        return view('frontend.orderCancelled', compact('txn'));
        // return view('frontend.orderCancelled');
    }


    public function orderConfirmation($order_id)
    {
        $txn = TransactionDetail::where('order_id', $order_id)->firstOrFail();
        return view('frontend.confirmation', compact('txn'));
    }





}