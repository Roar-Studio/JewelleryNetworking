<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Customer, Functions, OtpRequest, OtpMaster, MembershipPlan, Event, Enquiry, MediaImage, Feedback, GalleryCategory, Gallery};
use Illuminate\Support\Facades\{Hash, Auth, Storage, Cache, Validator, Response, Mail};
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\{OtpMail, WelcomeMail, WelcomeAdminMail, ContactAdminMail, CommunityAdminMail, ExpiryNotificationMail, MembershipAcknowledgementMail, ContactCustomerMail, CommunityCustomerMail, EventRegisteredMail, SuspiciousLoginMail, AddCommentMail, FeedbackFromMail, FeedbackToMail};
use Jenssegers\Agent\Agent;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use DB;
use Log;


class CustomerAuthController extends Controller
{
    public function sendDummyMail(Request $request)
    {
        // Mail::to('vishal.pawar@vervali.com')->send(new WelcomeMail('Vishal Pawar'));
        // Mail::to('vishal.pawar@vervali.com')->send(new OtpMail('123456'));
        // Mail::to('vishal.pawar@vervali.com')->send(new ContactAdminMail('123456', 'free', 'abc@abc.com', '8828644898', 'This is a test message', Carbon::now()->format('Y-m-d H:i:s')));
        // Mail::to('vishal.pawar@vervali.com')->send(new ContactCustomerMail('123456'));
        // Mail::to('vishal.pawar@vervali.com')->send(new ExpiryNotificationMail('abcd', Carbon::now()->addDays(30)->format('Y-m-d'), 'Premium', 'Some benefit text'));
        // Mail::to('vishal.pawar@vervali.com')->send(new MembershipAcknowledgementMail('abcd', Carbon::now()->addDays(30)->format('Y-m-d'), 'Premium', 'Some benefits', 'ORD123456'));
        // Mail::to('vishal.pawar@vervali.com')->send(new EventRegisteredMail('abcd', 'abc', 'address 123', Carbon::now()->addDays(30)->format('Y-m-d h:i:s'), 'ORD123456'));
        // Mail::to('vishal.pawar@vervali.com')->send(new SuspiciousLoginMail('abcd', 'abc', 'address 123', Carbon::now()->addDays(30)->format('Y-m-d h:i:s'), 'Device Info', 'Browser Info'));

        return response()->json(['status' => true, 'message' => 'Dummy mail sent successfully'], 200);
    }

    // Register API
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    public function saveNewCustomer(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'username' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[A-Za-z0-9\s.]+$/',
                Rule::unique('customers')->where('is_deleted', 0),
            ],
            'email' => [
                'required',
                'email',
                'max:60',
                Rule::unique('customers')->where('is_deleted', 0),
            ],
            'mobile_no' => [
                'required',
                'digits_between:7,15',
                Rule::unique('customers')->where('is_deleted', 0),
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'max:20',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?#&_]).+$/'
            ],
            'confirm_password' => 'required|same:password',
            'accept_consent' => 'required',
        ], [
            'password.regex' => 'Password must include uppercase, lowercase, number, and special character.',
            'accept_consent.required' => 'You must accept the Terms and Conditions.',
        ]);

        if ($validator->fails()) {
            return Response::json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 402);
        }

        $old_customer = Customer::where(function ($query) use ($request) {
            $query->where('mobile_no', $request->mobile_no)
                ->orWhere('email', $request->email)
                ->orWhere('username', $request->username);
        })
            ->first();

        if ($old_customer) {
            $requestCount = OtpRequest::where('customer_id', $old_customer->id)
                ->where('requested_at', '>=', Carbon::now()->subMinutes(30))
                ->count();

            if ($requestCount >= 5) {
                return Response::json([
                    'status' => false,
                    'message' => 'You have reached the maximum limit of 5 OTP requests in 30 minutes. Please try again later.'
                ], 200);
            }
        }

        // If connection exists and is already active
        if ($old_customer) {
            // Agar record already active hai aur delete nahi hua
            if ($old_customer->is_active == 1 && $old_customer->is_deleted == 0) {
                return Response::json([
                    'status' => false,
                    'message' => 'Connection already exists. Please log in using your existing account.'
                ], 200);
            }

            // Agar record delete flag ke sath hai to permanently delete kar do
            if ($old_customer->is_deleted == 1) {
                $old_customer->delete(); // hard delete from DB
            }
        }

        try {
            DB::beginTransaction();

            // Create a new user if no connection found
            $new_customer = new Customer();
            $new_customer->first_name = $request->first_name;
            $new_customer->last_name = $request->last_name;
            $new_customer->username = $request->username;
            $new_customer->category_id = $request->category_id;
            $new_customer->mobile_no = $request->mobile_no;
            $new_customer->mobile_no_cc = $request->mobile_no_cc;
            $new_customer->mobile_no_ic = $request->mobile_no_ic;
            $new_customer->email = $request->email;
            $new_customer->plan_type = 1;
            $new_customer->password = Hash::make($request->password);
            $new_customer->is_active = 0;
            $new_customer->is_deleted = 1;
            $new_customer->save();


            // Send OTP
            $otp = Functions::sendOTP($new_customer->id);

            // Example: send OTP to email (adjust 'vishal.pawar@gmail.com's accordingly)

            Mail::to($new_customer->email)->send(new OtpMail($otp->otp));
            DB::commit();

            return Response::json([
                'status' => true,
                'message' => 'OTP sent successfully',
                'email_id' => Functions::maskEmail($new_customer->email),
                'customer_id' => $new_customer->id,
                'token' => $otp->token
            ], 200);
        } catch (QueryException $e) {
            DB::rollBack();
            // Log the SQL + bindings for debugging
            Log::error('Some Error while saving customer', [
                'error' => $e->getMessage(),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Some error occurred while creating customer. Please try again.'
            ], 500);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('General Error while saving customer', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    public function resendCustomerOtp(Request $request)
    {
        $customer = Customer::find($request->id);
        $requestCount = OtpRequest::where('customer_id', $request->id)
            ->where('requested_at', '>=', Carbon::now()->subMinutes(30))
            ->count();

        if ($requestCount >= 5) {
            return response()->json([
                'status' => false,
                'message' => 'You have reached the maximum limit of 5 OTP requests in 30 minutes. Please try again after 30 minutes.'
            ], 200);
        }

        $otp = Functions::sendOTP($request->id);

        Mail::to($customer->email)->send(new OtpMail($otp->otp));

        return response()->json([
            'status' => true,
            'message' => 'OTP has been resent successfully.',
            // 'otp'=> $otp, 
            'customer_id' => $request->id,
            'token' => $otp->token
        ], 200);
    }

    public function validateRegistrationOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
            'customer_id' => 'required',
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return Response::json(['status' => false, 'message' => $validator->errors()->first(), 'errors' => $validator->errors()], 500);
        }

        $customer = Customer::find($request->customer_id);


        $old_customer = Customer::where(function ($query) use ($customer) {
            $query->where('mobile_no', $customer->mobile_no)
                ->orWhere('email', $customer->email)
                ->orWhere('username', $customer->username);
        })
            ->where('id', '!=', $customer->id)
            ->where('is_deleted', 0)
            ->first();
        if ($old_customer) {
            return Response::json([
                'status' => false,
                'message' => 'Connection already exists. Please contact admin support.'
            ], 200);
        }

        if ($customer->otp_attempts >= 3) {
            $firstFailedAttempt = new Carbon($customer->first_failed_attempt_at);
            if ($firstFailedAttempt->diffInMinutes(Carbon::now()) < 15) {
                return response()->json([
                    'status' => false,
                    'message' => 'You have been blocked for 15 minutes due to multiple failed OTP attempts. Please try again later.'
                ], 500);
            } else {
                // Reset the attempts after 15 minutes
                $customer->otp_attempts = 0;
                $customer->first_failed_attempt_at = null;
                $customer->save();
            }
        }

        $otpEntry = OtpMaster::where('token', $request->token)->where('customer_id', $request->customer_id)->where('otp', $request->otp)
            ->whereBetween('created_at', [
                Carbon::now()->subMinutes(10),
                Carbon::now()
            ])
            ->first();

        if ($otpEntry) {
            // Check if OTP is correct and not expired
            if ($otpEntry->otp == $request->otp) {
                $otpEntry->status = 1;
                $otpEntry->verified_at = Carbon::now()->format('Y-m-d H:i:s');
                $otpEntry->save();

                $customer->otp_attempts = 0;
                $customer->first_failed_attempt_at = null;
                $customer->is_active = 1;
                $customer->is_deleted = 0;
                $customer->save();

                //Generate Membership ID
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

                Mail::to($customer->email)->send(new WelcomeMail($customer->first_name, $membershipId));
                Mail::to(env('SALES_EMAIL'))->cc(['jagdish.gaikwad@vervali.com', 'jay.gupta@vervali.com'])
                    ->send(new WelcomeAdminMail($customer, $membershipId));

                return Response::json(['status' => true, 'message' => 'OTP Validated', 'customer_id' => $otpEntry->customer_id, 'token' => $request->token], 200);
            } else {
                // Increment the failed attempts
                if ($customer->otp_attempts == 0) {
                    $customer->first_failed_attempt_at = Carbon::now();
                }
                $customer->otp_attempts++;
                $customer->save();

                return response()->json([
                    'status' => false,
                    'message' => 'Invalid OTP'
                ], 500);
            }
        }
        return Response::json(['status' => false, 'message' => 'Invalid OTP or Token'], 500);
    }

    public function validateForgotOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
            'customer_id' => 'required',
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return Response::json(['status' => false, 'message' => $validator->errors()->first(), 'errors' => $validator->errors()], 500);
        }

        $customer = Customer::find($request->customer_id);

        if ($customer->otp_attempts >= 3) {
            $firstFailedAttempt = new Carbon($customer->first_failed_attempt_at);
            if ($firstFailedAttempt->diffInMinutes(Carbon::now()) < 15) {
                return response()->json([
                    'status' => false,
                    'message' => 'You have been blocked for 15 minutes due to multiple failed OTP attempts. Please try again later.'
                ], 500);
            } else {
                // Reset the attempts after 15 minutes
                $customer->otp_attempts = 0;
                $customer->first_failed_attempt_at = null;
                $customer->save();
            }
        }

        $otpEntry = OtpMaster::where('token', $request->token)->where('customer_id', $request->customer_id)->where('otp', $request->otp)
            ->whereBetween('created_at', [
                Carbon::now()->subMinutes(10),
                Carbon::now()
            ])
            ->first();

        if ($otpEntry) {
            // Check if OTP is correct and not expired
            if ($otpEntry->otp == $request->otp) {
                $otpEntry->status = 1;
                $otpEntry->verified_at = Carbon::now()->format('Y-m-d H:i:s');
                $otpEntry->save();

                $customer->otp_attempts = 0;
                $customer->first_failed_attempt_at = null;
                $customer->is_active = 1;
                $customer->save();

                return Response::json(['status' => true, 'message' => 'OTP Validated', 'customer_id' => $otpEntry->customer_id, 'token' => $request->token], 200);
            } else {
                // Increment the failed attempts
                if ($customer->otp_attempts == 0) {
                    $customer->first_failed_attempt_at = Carbon::now();
                }
                $customer->otp_attempts++;
                $customer->save();

                return response()->json([
                    'status' => false,
                    'message' => 'Invalid OTP'
                ], 500);
            }
        }
        return Response::json(['status' => false, 'message' => 'Invalid OTP or Token'], 500);
    }

    public function getForgotOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return Response::json(['status' => false, 'message' => 'Validation failed', 'errors' => $validator->errors()], 500);
        }

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            return Response::json(['status' => false, 'message' => 'Consumer Not Found'], 500);
        } elseif ($customer) {
            $requestCount = OtpRequest::where('customer_id', $customer->id)
                ->where('requested_at', '>=', Carbon::now()->subMinutes(30))
                ->count();
            if ($requestCount >= 5) {
                return response()->json([
                    'status' => false,
                    'message' => 'You have reached the maximum limit of 5 OTP requests in 30 minutes. Please try again after 30 minutes.'
                ], 500);
            }
            $otp = Functions::sendOTP($customer->id);

            Mail::to($customer->email)->send(new OtpMail($otp->otp));


            return Response::json(['status' => true, 'message' => 'OTP sent successfully', 'customer_id' => $customer->id, 'token' => $otp->token], 200);
        }
    }

    public function saveNewPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W])[A-Za-z\d\W]{6,}$/'
            ],
            'customer_id' => 'required',
            'token' => 'required',
        ], [
            'password.regex' => 'The password must be at least 6 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'password.required' => 'Please enter a password.',
            'customer_id.required' => 'The connection ID is required.',
            'token.required' => 'The token is required.',
        ]);


        if ($validator->fails()) {
            return Response::json(['status' => false, 'message' => 'Validation failed', 'errors' => $validator->errors()], 500);
        }

        // Validate token
        $otpEntry = OtpMaster::where('token', $request->token)
            ->where('customer_id', $request->customer_id)
            ->where('status', 1)
            ->whereNotNull('verified_at')
            ->whereBetween('created_at', [
                Carbon::now()->subMinutes(10),
                Carbon::now()
            ])
            ->latest()->first();

        if (!$otpEntry) {
            return Response::json(['status' => false, 'message' => 'Invalid or expired token'], 500);
        }

        $customer = Customer::find($request->customer_id);
        if (!$customer) {
            return Response::json(['status' => false, 'message' => 'Customer not found'], 404);
        }

        // ✅ Check if new password is same as old
        if (Hash::check($request->password, $customer->password)) {
            return Response::json([
                'status' => false,
                'message' => 'New password cannot be the same as your old password.'
            ], 400);
        }

        $customer->password = Hash::make($request->password);
        $customer->save();
        if ($customer->save()) {
            return Response::json(['status' => true, 'message' => 'Password Updated Successfully'], 200);
        }
        return Response::json(['status' => false, 'message' => 'Unable to update password'], 500);
    }


    // Login API
    public function customerLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'device_id' => 'required|string',
        ]);

        $emailInput = $request->input('email');

        $existCustomer = Customer::where('is_deleted', 0)
            ->where('is_active', 1)
            ->where(function ($query) use ($emailInput) {
                $query->where('email', $emailInput)
                    ->orWhere('mobile_no', $emailInput)
                    ->orWhere('username', $emailInput);
            })
            ->first();


        $email = $existCustomer ? $existCustomer->email : $emailInput;

        $cacheKey = 'customer_login_attempts_' . $email;
        $lockoutKey = 'customer_login_lockout_' . $email;

        if (Cache::has($lockoutKey)) {
            $remaining = Cache::get($lockoutKey) - time();
            if ($remaining > 0) {
                return response()->json([
                    'message' => 'Your account has been temporarily blocked for 15 minutes due to multiple failed attempts. Please try again later.',
                ], 423);
            } else {
                Cache::forget($lockoutKey);
                Cache::forget($cacheKey);
            }
        }

        if (!$existCustomer || !Hash::check($request->password, $existCustomer->password)) {
            $attempts = Cache::get($cacheKey, 0) + 1;

            if ($attempts >= 5) {
                Cache::put($lockoutKey, time() + (15 * 60), now()->addMinutes(15));
                Cache::forget($cacheKey);

                return response()->json([
                    'message' => 'Your account has been temporarily blocked for 15 minutes due to multiple failed attempts. Please try again later.',
                ], 423);
            } else {
                Cache::put($cacheKey, $attempts, now()->addMinutes(15));
                return response()->json([
                    'message' => 'Please enter the correct email or password.',
                    'attempts' => $attempts,
                ], 422);
            }
        }

        Auth::guard('customer')->login($existCustomer);
        $user = Auth::guard('customer')->user();

        $agent = new Agent();
        $isMobile = $agent->isMobile() || $agent->isTablet();
        $deviceType = $isMobile ? 'mobile' : 'desktop';
        $currentDeviceId = $request->device_id;
        $expiry = now()->addDay();

        // Get all active tokens for this user and device type
        $activeTokens = $user->tokens()
            ->where('device_type', $deviceType)
            ->get();

        // Delete expired tokens
        foreach ($activeTokens as $token) {
            if ($token->expires_at && $token->expires_at->isPast()) {
                $token->delete();
            }
        }

        // Check for other device login
        $activeTokens = $user->tokens()
            ->where('device_type', $deviceType)
            ->where(function ($q) use ($expiry) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->get();

        // $otherDeviceToken = $activeTokens->firstWhere('device_id', '!=', $currentDeviceId);
        // if ($otherDeviceToken) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => "You are already logged in on another {$deviceType} device. Please log out from that device to continue.",
        //     ], 403);
        // }

        // // Delete same-device token (allow re-login)
        // $sameDeviceToken = $activeTokens->firstWhere('device_id', $currentDeviceId);
        // if ($sameDeviceToken) {
        //     $sameDeviceToken->delete();
        // }

        // Update user table device id
        // if ($deviceType === 'mobile') {
        //     $user->mobile_device_id = $currentDeviceId;
        // } else {
        //     $user->desktop_device_id = $currentDeviceId;
        // }
        // $user->save();

        // Create new token
        $newToken = $user->createToken('Customer API Token', ['*']);
        $plainTextToken = $newToken->plainTextToken;
        $tokenModel = $newToken->accessToken;

        $tokenModel->device_id = $currentDeviceId;
        $tokenModel->device_type = $deviceType;
        $tokenModel->expires_at = $expiry;
        $tokenModel->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful.',
            'user' => $user,
            'token' => $plainTextToken,
            'tokenExpiry' => 60 * 24,
        ], 200);
    }

    // Get Membership API
    public function getMembership(Request $request)
    {
        $memberships = MembershipPlan::where('is_active', 1)->get();

        if ($memberships->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No active memberships found'], 404);
        }

        // Decode HTML entities for benefits
        $memberships->transform(function ($membership) {
            $membership->benefits = html_entity_decode($membership->benefits);
            return $membership;
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Memberships list fetched',
            'data' => $memberships
        ], 200);
    }

    // public function getMembership(Request $request)
    // {
    //     return $memberships = MembershipPlan::where('is_active', 1)->get();
    //     if ($memberships->isEmpty()) {
    //         return response()->json(['status' => 'error', 'message' => 'No active memberships found'], 404);
    //     }
    //     return response()->json(['status' => 'success', 'message' => 'memberships list fetched', 'data' => $memberships], 200);
    // }

    public function getUserByMembershipId(Request $request)
    {
        $request->validate([
            'membership_number' => 'required|string'
        ]);

        $membershipNumber = $request->input('membership_number');

        // Extract numeric part of membership number
        $customerId = (int) preg_replace('/[^0-9]/', '', $membershipNumber);

        // Fetch user by ID
        $customer = Customer::find($customerId);

        if (!$customer) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
                'data' => null
            ], 404);
        }


        return response()->json([
            'status' => 'success',
            'message' => 'memberships list fetched',
            'data' => $customer
        ], 200);
    }

    public function getEventDetail(Request $request, $event_id = null)
    {
        $today = Carbon::now()->format('Y-m-d H:i:s');

        $event = Event::with('sponsors')
            ->withCount(['transactions as completed_transaction_count' => function ($query) {
                $query->where('status', 'completed');
            }])
            ->where('is_active', 1)
            ->where('is_deleted', 0)
            ->where('id', $event_id)
            ->first();
        if (!$event) {
            return response()->json(['status' => 'error', 'message' => 'No event found'], 200);
        }
        return response()->json(['status' => 'success', 'message' => 'Events list fetched', 'data' => $event], 200);
    }

    // Get Events API
    public function getEvents(Request $request)
    {
        $query = Event::withCount(['transactions as completed_transaction_count' => function ($query) {
            $query->where('status', 'completed');
        }])
            ->where('is_active', 1)
            ->where('is_deleted', 0);

        // Only apply date filtering if view_type is 'month'
        if ($request->has('view_type') && $request->input('view_type') === 'month') {
            if ($request->has('start_date') && $request->has('end_date')) {
                $query->whereBetween('event_start_datetime', [
                    $request->input('start_date'),
                    $request->input('end_date')
                ]);
            }
        }

        $events = $query->orderBy('event_start_datetime', 'desc')->get();

        if ($events->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No events found', 'data' => []], 200);
        }

        return response()->json(['status' => 'success', 'message' => 'Events list fetched', 'data' => $events], 200);
    }

    // Get Authenticated User API
    public function user(Request $request)
    {
        // dd(Auth::guard('customer-api')->user());
        if (Auth::guard('customer-api')->check()) {
            return response()->json(['status' => 'success', 'data' => ['user' => Auth::guard('customer-api')->user()]], 200); // in minutes
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
    }

    // public function logout(Request $request)
    // {
    //     $user = Auth::guard('customer-api')->user();

    //     if ($user) {
    //         $agent = new Agent();
    //         $isMobile = $agent->isMobile() || $agent->isTablet();
    //         $deviceType = $isMobile ? 'mobile' : 'desktop';
    //         $currentDeviceId = $request->input('device_id');

    //         // Clear device ID only if matches
    //         if ($deviceType === 'mobile' && $user->mobile_device_id === $currentDeviceId) {
    //             $user->mobile_device_id = null;
    //         } elseif ($deviceType === 'desktop' && $user->desktop_device_id === $currentDeviceId) {
    //             $user->desktop_device_id = null;
    //         }

    //         // Delete token for this specific device
    //         $accessToken = $request->user()->currentAccessToken();
    //         if ($accessToken instanceof \Laravel\Sanctum\PersonalAccessToken) {
    //             $accessToken->delete();
    //         }

    //         $user->save();
    //         Auth::guard('customer')->logout();

    //         $request->session()->invalidate();
    //         $request->session()->regenerateToken();

    //         return response()->json([
    //             'message' => 'Logged out successfully',
    //             'device_type' => $deviceType,
    //         ], 200);
    //     }

    //     return response()->json(['message' => 'No user found'], 401);
    // }

    public function logout(Request $request)
    {
        // Try to get the user from either guard
        $user = Auth::guard('customer-api')->user() ?? Auth::guard('customer')->user();

        if (!$user) {
            return response()->json(['message' => 'No user found'], 401);
        }

        $agent = new \Jenssegers\Agent\Agent();
        $isMobile = $agent->isMobile() || $agent->isTablet();
        $deviceType = $isMobile ? 'mobile' : 'desktop';
        // $currentDeviceId = $request->input('device_id');

        // Remove stored device ID if matches
        // if ($deviceType === 'mobile' && $user->mobile_device_id === $currentDeviceId) {
        //     $user->mobile_device_id = null;
        // } elseif ($deviceType === 'desktop' && $user->desktop_device_id === $currentDeviceId) {
        //     $user->desktop_device_id = null;
        // }

        // 🔹 Case 1: Sanctum token-based logout (API)
        if ($accessToken = $request->user()?->currentAccessToken()) {
            $accessToken->delete();
        }

        // 🔹 Case 2: Session-based logout (web guard)
        if (Auth::guard('customer')->check()) {
            Auth::guard('customer')->logout();
            if ($request->hasSession()) {
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }
        }

        $user->save();

        return response()->json([
            'message' => 'Logged out successfully',
            'device_type' => $deviceType,
        ], 200);
    }



    public function getMembers(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'plan_type' => 'nullable|in:1,2,3',         // 1: Free, 2: Standard, 3: Premium
            'alphabet'  => 'nullable|string|size:1',    // Single alphabet letter A-Z
            'search'    => 'nullable|string|max:255',   // Search query
            'offset'    => 'nullable|integer|min:0',
            'limit'     => 'nullable|integer|min:1|max:100',
            'category' => 'nullable'
        ]);

        $user = Auth::guard('customer-api')->user();

        // Use defaults if not provided
        $planType = $validated['plan_type'] ?? null;
        $alphabet = $validated['alphabet'] ?? null;
        $search = $validated['search'] ?? null;
        $offset = $validated['offset'] ?? 0;
        $limit = $validated['limit'] ?? 10;
        $category = $validated['category'] ?? null;

        $query = Customer::query();

        // Check user plan type
        if ($user->plan_type != 1) {
            $query->where('id', '!=', $user->id)
                ->where('plan_type', '<=', $user->plan_type);
        } else {
            $query->whereRaw('1 = 0');
        }

        // Filter by plan type if specified
        if (!is_null($planType)) {
            $query->where('plan_type', $planType);
        }

        // Filter by alphabet (first letter of first name)
        if (!is_null($alphabet) && trim($alphabet) !== '') {
            $letter = strtoupper(trim($alphabet));
            if (preg_match('/^[A-Z]$/', $letter)) {
                $query->where('first_name', 'LIKE', $letter . '%');
            }
        }

        // Search functionality - name or mobile number
        if (!is_null($search) && trim($search) !== '') {
            $searchTerm = trim($search);
            $query->where(function ($q) use ($searchTerm) {
                // Search in first name
                $q->where('first_name', 'LIKE', "%{$searchTerm}%")
                    // Search in last name
                    ->orWhere('last_name', 'LIKE', "%{$searchTerm}%")
                    // Search in full name (combined)
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$searchTerm}%"])
                    // Search in mobile number (without country code)
                    ->orWhere('mobile_no', 'LIKE', "%{$searchTerm}%")
                    // Search in mobile number with country code
                    ->orWhereRaw("CONCAT(mobile_no_cc, mobile_no) LIKE ?", ["%{$searchTerm}%"])
                    // Search in company name (bonus)
                    ->orWhere('company_name', 'LIKE', "%{$searchTerm}%");
            });
        }
        if (!is_null($category)) {
            $query->where('category_id', $category);
        }

        // Sort by name (always A-Z)
        $query->orderBy('first_name', 'asc');

        // Apply pagination
        $members = $query->offset($offset)->limit($limit)->get();

        // Format response
        $formatted['members'] = $members->map(function ($member) {
            return [
                'id' => $member->id,
                'name' => $member->first_name . ' ' . $member->last_name,
                'company_name' => $member->company_name ?? '',
                'mobile_no' => $member->mobile_no_cc . '-' . $member->mobile_no,
                'email' => $member->email,
                'plan_label' => $this->getPlanLabel($member->plan_type),
                'added_by' => $member->added_by ?? 'Admin',
                'image_url' => $member->company_logo ? asset('storage/' . $member->company_logo) : asset('new_ui/assets/images/directory-img.png'),
            ];
        });
        $formatted['user_plan'] = $user->plan_type;

        return response()->json([
            'status' => 'success',
            'data' => $formatted
        ]);
    }

    public function getMemberById(Request $request, $memberId)
    {

        $user = Auth::guard('customer-api')->user();

        $query = Customer::query()->with('membership_plan')->where('id', '!=', $user->id)->where('plan_type', '<=', $user->plan_type);

        // Apply pagination
        $member = $query->where('id', $memberId)->first();
        if (!$member) {
            return response()->json(['status' => 'error', 'message' => 'Member not found'], 404);
        }
        $is_feedback_given = Feedback::where('customer_id', $user->id)
            ->where('member_id', $memberId)
            ->exists();
        $member->is_feedback_given = $is_feedback_given;

        $rating = Feedback::where('member_id', $memberId)->avg('rating');
        $member->rating = $rating ? (int) round($rating) : 0;

        // $formatted = [
        //         'name' => $member->first_name .' '. $member->last_name,
        //         'company_name' => $member->company_name ?? '',
        //         'mobile_no' => $member->mobile_no_cc.'-'.$member->mobile_no,
        //         'email' => $member->email,
        //         'plan_label' => $this->getPlanLabel($member->plan_type),
        //         'added_by' => $member->added_by ?? 'Admin',
        //         'image_url' => $member->company_logo ? asset('storage/' . $member->company_logo) : asset('new_ui/assets/images/directory-img.png'),
        //     ];

        return response()->json([
            'status' => 'success',
            'message' => 'Member details fetched successfully',
            'data' => $member
        ]);
    }

    public function getAllFolders(Request $request)
    {
        $folders = GalleryCategory::with('thumbnail')->where('is_active', 1)
            ->where('is_deleted', 0)
            ->orderBy('gallery_date', 'desc') // Optional: sort by latest
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Folders fetched successfully',
            'data' => $folders
        ]);
    }

    public function getGalleryImages(Request $request, $category_id)
    {
        $gallery = GalleryCategory::with('media_files')->where('is_active', 1)
            ->where('is_deleted', 0)
            ->where('id', $category_id) // Optional: sort by latest
            ->first();

        return response()->json([
            'status' => 'success',
            'message' => 'Gallery fetched successfully',
            'data' => $gallery
        ]);
    }


    public function getBasicDetails(Request $request)
    {
        $user = Auth::guard('customer-api')->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated'
            ], 401);
        }

        // Membership ID Logic (same as list page)
        $prefix = match ((int)$user->plan_type) {
            1 => 'F',
            2 => 'S',
            3 => 'P',
            default => 'X',
        };

        if ($prefix != 'X') {
            $membershipId = $prefix . str_pad($user->id, 6, '0', STR_PAD_LEFT);
        } else {
            $membershipId = '';
        }

        // Add membership_id to user response
        $user->membership_id = $membershipId;

        return response()->json([
            'status' => 'success',
            'message' => 'basic details fetched',
            'data' => $user
        ], 200);
    }


    public function getCompanyDetails(Request $request)
    {
        $user = Auth::guard('customer-api')->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
        }
        $user->load('media_images');

        return response()->json(['status' => 'success', 'data' => $user], 200);
    }
    public function getSubscriptionDetails(Request $request)
    {
        $user = Auth::guard('customer-api')->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
        }
        // dd($user);
        $customer = Customer::with('membership_plan')->find($user->id);
        if (!$customer) {
            return response()->json(['status' => 'error', 'message' => 'Membership plan not found'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $customer], 200);
    }

    public function getTransactionDetails(Request $request)
    {
        $user = Auth::guard('customer-api')->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
        }

        $transactions = $user->transactions()->get();

        if ($transactions->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No transactions found'], 200);
        }

        return response()->json(['status' => 'success', 'data' => $transactions], 200);
    }

    public function checkValidUserName(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100',
        ]);

        $customer = Auth::guard('customer-api')->user();


        // Get the customer ID and username from the request
        $customerId = $customer->id;
        $username = $request->username;

        // Check if the username is unique (ignoring the current customer)
        $usernameExists = Customer::where('username', $username)
            ->where('id', '!=', $customerId)  // Exclude the current customer ID
            ->exists();

        // Return response
        if ($usernameExists) {
            return response()->json([
                'status' => false,
                'message' => 'username already exists.',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'username is available.',
        ]);
    }

    private function getPlanLabel($type)
    {
        return match ((int)$type) {
            1 => 'Free',
            2 => 'Standard',
            3 => 'Premium',
            default => 'Unknown',
        };
    }

    public function addEnquiry(Request $request)
    {
        // First validate other fields
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:20',
            'captcha' => 'required|string|min:6'
        ]);

        // Manually check captcha (more reliable)
        if (!captcha_check($request->captcha)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid CAPTCHA code. Please try again.',
                'errors' => [
                    'captcha' => ['The CAPTCHA code you entered is incorrect']
                ]
            ], 422);
        }

        try {
            $enquiry = Enquiry::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,
                'company_name' => $request->company_name,
                'message' => $request->message,
            ]);

            // Send emails
            Mail::to(env('SALES_EMAIL'))
                ->cc(['jagdish.gaikwad@vervali.com', 'jay.gupta@vervali.com'])
                ->send(new ContactAdminMail(
                    $enquiry->first_name,
                    $enquiry->last_name,
                    $enquiry->company_name,
                    $enquiry->country,
                    $enquiry->email,
                    $enquiry->phone,
                    $enquiry->message,
                    $enquiry->created_at->format('Y-m-d H:i:s')
                ));

            Mail::to($enquiry->email)
                ->send(new ContactCustomerMail($enquiry->first_name . ' ' . $enquiry->last_name));

            return response()->json([
                'status' => 'success',
                'message' => 'Enquiry submitted successfully',
                'data' => $enquiry
            ]);
        } catch (\Exception $e) {
            \Log::error('Enquiry submission error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to submit enquiry. Please try again.'
            ], 500);
        }
    }

    public function sendToCommunity(Request $request)
    {
        // First validate basic fields
        $validated = $request->validate([
            'email' => 'required|email|max:150',
            'captcha' => 'required|string|min:6'
        ]);

        // Manually check captcha (more reliable than 'captcha' rule)
        if (!captcha_check($request->captcha)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid CAPTCHA code. Please try again.',
                'errors' => [
                    'captcha' => ['The CAPTCHA code you entered is incorrect']
                ]
            ], 422);
        }

        try {
            // Send emails
            Mail::to(env('SALES_EMAIL'))
                ->cc(['jagdish.gaikwad@vervali.com', 'jay.gupta@vervali.com'])
                ->send(new CommunityAdminMail($request->email));

            Mail::to($request->email)
                ->send(new CommunityCustomerMail($request->email));

            return response()->json([
                'status' => 'success',
                'message' => 'Request submitted successfully',
            ]);
        } catch (\Exception $e) {
            \Log::error('Community submission error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to submit request. Please try again.'
            ], 500);
        }
    }

    public function updateBasicDetails(Request $request)
    {
        try {
            $user = Auth::guard('customer-api')->user();
            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
            }

            $validated = $request->validate([
                'first_name' => 'required|string|max:50',
                'last_name' => 'nullable|string|max:50',
                'email' => 'required|email|max:100',
                'mobile_no' => 'required|string|max:20',
                'mobile_no_cc' => 'required',
                'mobile_no_ic' => 'required',
            ]);

            $user->update($validated);

            return response()->json(['status' => 'success', 'message' => 'Basic details updated successfully', 'data' => $user], 200);
        } catch (QueryException $e) {
            Log::error('Some Error', [
                'error' => $e->getMessage(),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Some error occurred. Please try again.'
            ], 500);
        } catch (\Exception $e) {
            Log::error('General Error', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    public function updateCompanyDetails(Request $request)
    {
        $user = Auth::guard('customer-api')->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
        }

        $validated = $request->validate([
            'company_name' => 'required|string|min:3|max:50',
            'category_id' => 'required|exists:categories,id',
            'company_address' => 'required|string|max:200',
            'trn_no' => 'nullable|string|max:50',
            'google_map_link' => 'nullable|url',
            'specialization' => 'nullable|string|max:100',
            'business_description' => 'nullable|string|max:500',
            'website' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'facebook_link' => 'nullable|url',
            'x_link' => 'nullable|url',
            'youtube_link' => 'nullable|url',

            // Updated validation for direct file upload
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'media_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'company_video' => 'nullable|mimes:mp4,webm,ogg|max:5120', // 5MB
        ]);

        try {
            // Delete old files
            if ($request->hasFile('company_logo') && $user->company_logo) {
                Storage::delete('public/' . $user->company_logo);
            }
            if ($request->hasFile('company_video') && $user->company_video) {
                Storage::delete('public/' . $user->company_video);
            }

            // Update basic fields
            $user->company_name = $validated['company_name'];
            $user->category_id = $validated['category_id'];
            $user->company_address = $validated['company_address'];
            $user->trn_no = $validated['trn_no'] ?? null;
            $user->google_map_link = $validated['google_map_link'] ?? null;
            $user->specialization = $validated['specialization'] ?? null;
            $user->business_description = $validated['business_description'] ?? null;
            $user->website = $validated['website'] ?? null;
            $user->linkedin_link = $validated['linkedin_link'] ?? null;
            $user->instagram_link = $validated['instagram_link'] ?? null;
            $user->facebook_link = $validated['facebook_link'] ?? null;
            $user->x_link = $validated['x_link'] ?? null;
            $user->youtube_link = $validated['youtube_link'] ?? null;

            // Handle file uploads (Direct file upload, not base64)
            if ($request->hasFile('company_logo')) {
                $user->company_logo = $request->file('company_logo')->store('company_logo', 'public');
            }

            if ($request->hasFile('company_video')) {
                $user->company_video = $request->file('company_video')->store('company_video', 'public');
            }

            // Handle media images
            if ($request->hasFile('media_images')) {
                foreach ($request->file('media_images') as $mediaImage) {
                    $path = $mediaImage->store('media_images', 'public');

                    MediaImage::create([
                        'customer_id' => $user->id,
                        'image' => $path,
                    ]);
                }
            }

            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Company details updated successfully',
                'data' => $user
            ], 200);
        } catch (QueryException $e) {
            Log::error('Database Error', [
                'error' => $e->getMessage(),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Database error occurred. Please try again.'
            ], 500);
        } catch (\Exception $e) {
            Log::error('General Error', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    public function submitFeedback(Request $request)
    {
        $user = Auth::guard('customer-api')->user();
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'member_id' => 'required|exists:customers,id',
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            $member = Customer::find($validated['member_id']);

            $feedback = new Feedback();
            $feedback->customer_id = $user->id;
            $feedback->member_id = $validated['member_id'];
            $feedback->rating = $validated['rating'];
            $feedback->feedback = $validated['feedback'] ?? null;
            $feedback->save();

            DB::commit();

            // ✅ Send emails (non-blocking, after commit)
            try {
                // Send confirmation mail to feedback giver (the logged-in user)
                if (!empty($user->email)) {
                    Mail::to($user->email)->send(
                        new FeedbackFromMail(
                            $member->first_name . ' ' . $member->last_name,  // toName (receiver)
                            $user->first_name . ' ' . $user->last_name,      // fromName (who feedback is about)
                            $feedback->rating,
                            $feedback->feedback
                        )
                    );
                    Log::info('send from mail', [
                        $member->first_name . ' ' . $member->last_name,  // toName (receiver)
                        $user->first_name . ' ' . $user->last_name,      // fromName (who feedback is about)
                        $feedback->rating,
                        $feedback->feedback
                    ]);
                }

                // Send notification mail to feedback receiver (the member)
                if (!empty($member->email)) {
                    Mail::to($member->email)->send(
                        new FeedbackToMail(
                            $user->first_name . ' ' . $user->last_name,      // fromName (who gave feedback)
                            $member->first_name . ' ' . $member->last_name,  // toName (receiver)
                            $feedback->rating,
                            $feedback->feedback
                        )
                    );

                    Log::info('send to mail', [
                        $member->first_name . ' ' . $member->last_name,  // toName (receiver)
                        $user->first_name . ' ' . $user->last_name,      // fromName (who feedback is about)
                        $feedback->rating,
                        $feedback->feedback
                    ]);
                }
            } catch (\Throwable $mailError) {
                // Don’t break the flow if mail fails
                Log::warning('Feedback email sending failed', [
                    'user_id' => $user->id,
                    'member_id' => $member->id ?? null,
                    'error' => $mailError->getMessage(),
                ]);
            }

            return response()->json(['status' => 'success', 'message' => 'Feedback submitted successfully'], 200);
        } catch (QueryException $e) {
            DB::rollBack();
            // Log the SQL + bindings for debugging
            Log::error('Some Error', [
                'error' => $e->getMessage(),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Some error occurred. Please try again.'
            ], 500);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('General Error', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    /* public function submitComment(Request $request)
    {
        $user = Auth::guard('customer-api')->user(); // or Auth::user() based on guard

        $validated = $request->validate([
            'member_id' => 'required|exists:customers,id',
            'title' => 'required|string|max:255',
            'comment' => 'nullable|string|max:1000',
            'file' => 'nullable|string', // base64 encoded string
        ]);

        try{
            // Optional: Handle base64 file if needed (e.g. save to storage)
            // Example: store base64 file and get path
            $filePath = null;
            if (!empty($validated['file'])) {
                $fileData = $validated['file'];
                $filePath = Helper::storeBase64File($fileData, 'comments'); // your helper method
            }
            // dd(public_path($filePath));
            $member = Customer::find($validated['member_id']);
            if ($member) {
                Mail::to($member->email)->send(
                    new AddCommentMail($user, $member, $validated, $filePath)
                );
                
            }

            // Send email

            return response()->json([
                'status' => 'success',
                'message' => 'Comment submitted successfully!'
            ]);
        
        } catch (QueryException $e) {
            Log::error('Some Error', [
                'error' => $e->getMessage(),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Some error occurred. Please try again.'
            ], 500);

        } catch (\Exception $e) {
            Log::error('General Error', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    } */
    public function submitComment(Request $request)
    {
        $user = Auth::guard('customer-api')->user();

        $validated = $request->validate([

            'member_id' => 'required|exists:customers,id',

            'title' => 'required|string|max:255',

            'comment' => 'nullable|string|max:1000',

            // FILE VALIDATION
            'file' =>
            'nullable|file|mimes:pdf,doc,docx,txt,png,jpg,jpeg,xlsx|max:5120',

        ]);

        try {

            $filePath = null;

            /*
            =====================================
            HANDLE FILE UPLOAD
            =====================================
            */

            if ($request->hasFile('file')) {

                $file = $request->file('file');

                $fileName =
                    time() . '_' .
                    $file->getClientOriginalName();

                $filePath =
                    $file->storeAs(
                        'comments',
                        $fileName,
                        'public'
                    );
            }


            /*
            =====================================
            SEND EMAIL
            =====================================
            */

            $member =
                Customer::find(
                    $validated['member_id']
                );

            if ($member) {

                Mail::to($member->email)->send(

                    new AddCommentMail(
                        $user,
                        $member,
                        $validated,
                        $filePath
                    )

                );
            }


            return response()->json([

                'status' => 'success',
                'message' =>
                'Comment submitted successfully!'

            ]);
        } catch (\Exception $e) {

            Log::error('General Error', [
                'error' => $e->getMessage()
            ]);

            return response()->json([

                'status' => 'error',
                'message' =>
                'Something went wrong. Please try again later.'

            ], 500);
        }
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::guard('customer-api')->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
        }

        $validated = $request->validate([
            'old_password' => 'required|string|min:8',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:20',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?#&_]).+$/'
            ],
            'confirm_password' => 'required|same:password',
        ], [
            'password.regex' => 'Password must include uppercase, lowercase, number, and special character.',
        ]);

        if (!Hash::check($validated['old_password'], $user->password)) {
            return response()->json(['status' => false, 'message' => 'Old password is incorrect'], 422);
        }

        // Check if new password is same as old password
        if (Hash::check($validated['password'], $user->password)) {
            return response()->json(['status' => false, 'message' => 'For security, please create a password different from those recently used.'], 422);
        }

        try {
            $user->password = Hash::make($validated['password']);
            $user->save();

            return response()->json(['status' => true, 'message' => 'Password updated successfully'], 200);
        } catch (QueryException $e) {
            Log::error('Some Error', [
                'error' => $e->getMessage(),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Some error occurred. Please try again.'
            ], 500);
        } catch (\Exception $e) {
            Log::error('General Error', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    /* public function updateProfileImage(Request $request)
    {
        $user = Auth::guard('customer-api')->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
        }

        $validated = $request->validate([
            'profile_photo' => 'nullable|string',
        ]);

        try{
            if ($request->hasFile('profile_photo')) {
                $image = $request->file('profile_photo');
                $imagePath = $image->store('profile_photos', 'public');
                $user->profile_photo = $imagePath;
                $user->save();
            }
            if (!empty($request->profile_photo)) {
                $user->profile_photo = Helper::storeBase64Image($request->profile_photo, 'profile_photo');
            }
            if (!$user->save()) {
                return response()->json(['status' => 'error', 'message' => 'Failed to update profile image'], 500);
            }

            return response()->json(['status' => 'success', 'message' => 'Profile image updated successfully', 'data' => ['profile_photo' => asset('storage/' . $user->profile_photo)]], 200);
        
        } catch (QueryException $e) {
            Log::error('Some Error', [
                'error' => $e->getMessage(),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Some error occurred. Please try again.'
            ], 500);

        } catch (\Exception $e) {
            Log::error('General Error', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    } */
    public function updateProfileImage(Request $request)
    {
        $user = Auth::guard('customer-api')->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated'
            ], 401);
        }

        /*
        ===============================
        VALIDATION
        ===============================
        */

        $validated = $request->validate([

            'profile_photo' =>
            'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'

        ]);

        try {

            /*
            ===============================
            HANDLE FILE UPLOAD
            ===============================
            */

            if ($request->hasFile('profile_photo')) {

                /*
                DELETE OLD IMAGE
                */

                if (
                    $user->profile_photo &&
                    Storage::exists('public/' . $user->profile_photo)
                ) {

                    Storage::delete(
                        'public/' . $user->profile_photo
                    );
                }

                /*
                STORE NEW IMAGE
                */

                $file =
                    $request->file('profile_photo');

                $fileName =
                    time() . '_profile.' .
                    $file->getClientOriginalExtension();

                $imagePath =
                    $file->storeAs(
                        'profile_photos',
                        $fileName,
                        'public'
                    );

                $user->profile_photo =
                    $imagePath;

                $user->save();
            }

            return response()->json([

                'status' => 'success',

                'message' =>
                'Profile image updated successfully',

                'data' => [

                    'profile_photo' =>
                    asset(
                        'storage/' .
                            $user->profile_photo
                    )

                ]

            ], 200);
        } catch (\Exception $e) {

            Log::error('Profile Image Error', [

                'error' =>
                $e->getMessage()

            ]);

            return response()->json([

                'status' => 'error',

                'message' =>
                'Something went wrong. Please try again later.'

            ], 500);
        }
    }

    public function removeMediaImage(Request $request, $id)
    {
        $user = Auth::guard('customer-api')->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
        }

        $mediaImage = MediaImage::where('id', $id)->where('customer_id', $user->id)->first();
        if (!$mediaImage) {
            return response()->json(['status' => 'error', 'message' => 'Media image not found'], 404);
        }

        // Delete the image file from storage
        if (Storage::exists('public/' . $mediaImage->image)) {
            Storage::delete('public/' . $mediaImage->image);
        }

        // Delete the media image record
        $mediaImage->delete();

        return response()->json(['status' => 'success', 'message' => 'Media image removed successfully'], 200);
    }

    public function removeUploaded(Request $request)
    {
        $user = Auth::guard('customer-api')->user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 401);
        }

        $customer = Customer::where('id', $user->id)->first();
        if ($customer) {
            if ($request->type == 'company_logo') {
                if (Storage::exists('public/' . $customer->company_logo)) {
                    Storage::delete('public/' . $customer->company_logo);
                }
                $customer->company_logo = null;
            }
            if ($request->type == 'profile_photo') {
                if (Storage::exists('public/' . $customer->profile_photo)) {
                    Storage::delete('public/' . $customer->profile_photo);
                }
                $customer->profile_photo = null;
            }
            if ($request->type == 'company_video') {
                if (Storage::exists('public/' . $customer->company_video)) {
                    Storage::delete('public/' . $customer->company_video);
                }
                $customer->company_video = null;
            }
            $customer->save();
            return response()->json(['status' => 'success', 'message' => 'Image removed successfully'], 200);
        }

        return response()->json(['status' => 'success', 'message' => 'Image removed successfully'], 200);
    }


    //video functions
    public function getVideoGallery($categoryId)
    {
        try {
            $category = GalleryCategory::with(['videos' => function ($query) {
                $query->where('is_active', 1)
                    ->where('is_deleted', 0)
                    ->orderBy('created_at', 'desc');
            }])->findOrFail($categoryId);

            $videos = $category->videos->map(function ($video) {
                // Convert YouTube URL to embed URL
                $embedUrl = $this->convertToEmbedUrl($video->youtube_url);
                $thumbnailUrl = $this->getYoutubeThumbnail($video->youtube_url);

                return [
                    'id' => $video->id,
                    'youtube_url' => $video->youtube_url,
                    'embed_url' => $embedUrl,
                    'thumbnail_url' => $thumbnailUrl,
                    'gallery_type' => $video->gallery_type,
                    'created_at' => $video->created_at,
                ];
            });

            return response()->json([
                'status' => 'success',
                'data' => [
                    'category_name' => $category->name,
                    'videos' => $videos
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error fetching video gallery: ' . $e->getMessage()
            ], 500);
        }
    }
    private function convertToEmbedUrl($url)
    {
        // Handle different YouTube URL formats
        $videoId = null;

        if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $url, $matches)) {
            $videoId = $matches[1];
        } elseif (preg_match('/youtu\.be\/([^?]+)/', $url, $matches)) {
            $videoId = $matches[1];
        } elseif (preg_match('/youtube\.com\/embed\/([^?]+)/', $url, $matches)) {
            $videoId = $matches[1];
        }

        return $videoId ? "https://www.youtube.com/embed/{$videoId}" : $url;
    }
    private function getYoutubeThumbnail($url)
    {
        $videoId = null;

        if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $url, $matches)) {
            $videoId = $matches[1];
        } elseif (preg_match('/youtu\.be\/([^?]+)/', $url, $matches)) {
            $videoId = $matches[1];
        } elseif (preg_match('/youtube\.com\/embed\/([^?]+)/', $url, $matches)) {
            $videoId = $matches[1];
        }

        return $videoId ? "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg" : null;
    }
}
