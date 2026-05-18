<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Customer, Category};
use Illuminate\Support\Facades\{Hash, Auth,Cache};
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use DB;
use Log;


class AuthController extends Controller
{
    // Register API
    public function register(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);

            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('API Token')->plainTextToken;

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => 'User registered successfully.',
                'user'    => $user,
                'token'   => $token
            ], 201);

        } catch (QueryException $e) {
            DB::rollBack();

            Log::error('Database Error during registration', [
                'error'    => $e->getMessage(),
                'sql'      => $e->getSql(),
                'bindings' => $e->getBindings(),
            ]);

            return response()->json([
                'status'  => 'error',
                'message' => 'Database error occurred. Please try again.'
            ], 500);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('General Error during registration', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }


    // Login API
    public function login(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_id' => 'required|string',
        ]);

        $email = $request->input('email');
        $cacheKey = 'login_attempts_' . $email;
        $lockoutKey = 'login_lockout_' . $email;

        // ✅ STEP 1: Block if locked
        if (Cache::has($lockoutKey)) {
            $remaining = Cache::get($lockoutKey) - time();
            // dd($remaining);

            if ($remaining > 0) {
                return response()->json([
                    'message' => 'Your account has been temporarily blocked for 15 minutes due to multiple failed attempts. Please try again later.',
                ], 423);
            } else {
                Cache::forget($lockoutKey);
                Cache::forget($cacheKey);
            }
        }

        // ✅ STEP 2: Attempt login
        if (!Auth::attempt($request->only('email', 'password'))) {
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
                    'message' => 'Please enter the correct username or password.',
                    'attempts' => $attempts,
                ], 422);
            }
        }

        // ✅ STEP 3: If credentials are correct, check if user is still locked (again)
        if (Cache::has($lockoutKey)) {
            $remaining = Cache::get($lockoutKey) - time();
            if ($remaining > 0) {
                Auth::logout(); // Log out the user in case login went through
                return response()->json([
                    'message' => 'Your account is still locked. Please try again later.',
                ], 423);
            } else {
                Cache::forget($lockoutKey);
                Cache::forget($cacheKey);
            }
        }

        // ✅ STEP 4: Successful login — clear attempts and issue token
        Cache::forget($cacheKey);
        Cache::forget($lockoutKey);

        $user = Auth::user();
        
        $currentUserAgent = $request->header('User-Agent');
        $currentIp = $request->ip();
        $currentDeviceId = $request->device_id;
        
        $existingToken = $user->tokens()->latest()->first();

        if ($existingToken && $existingToken->expires_at->isPast()) {
            $user->tokens()->delete();
            $user->device_id = null;
            $user->session_id = null;
            $user->user_agent = null;
            $user->ip_address = null;
            $user->save();
        }
        
        if ($user->device_id && $user->device_id !== $currentDeviceId && $existingToken && !$existingToken->expires_at->isPast()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are already logged in on another device. Please log out first.',
            ], 403);
        }


        $user->tokens()->delete();

        $sessionId = \Str::uuid();
        $user->session_id = $sessionId;
        $user->device_id = $currentDeviceId;
        $user->user_agent = $currentUserAgent;
        $user->ip_address = $currentIp;
        $user->save();

        $token = $user->createToken('API Token', ['*'], now()->addDay())->plainTextToken;

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'token' => $token,
            'tokenExpiry' => 60 * 24,
        ], 200);
    }



    // Get Authenticated User API
    public function user(Request $request)
    {
        // dd($request->user());
        return response()->json(['status' => 'success','user' => $request->user() ], 200); // in minutes

    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            
            // Revoke the current access token
            if ($request->user()->tokens()->count() > 0) {
                $request->user()->tokens()->delete();
            }
            // Clear session ID to restrict further access
            $user->session_id = null;
            $user->device_id = null;
            $user->user_agent = null;
            $user->ip_address = null;
            $user->save();            
            // CRITICAL: This removes the session data you see persisting
            $request->session()->invalidate();
            
            // This generates a new CSRF token for the next login attempt
            $request->session()->regenerateToken();
            // $request->session()->flush();
        }

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = fopen($request->file('csv_file'), 'r');
        $header = fgetcsv($file);

        // Country to mobile code mapping
        $countryCodeMap = [
            'IN' => '+91',
            'US' => '+1',
            'PK' => '+92',
            'AE' => '+971',
            'UK' => '+44',
            'CA' => '+1',
            'TH' => '+66',
            // Add more as needed
        ];

        $categoryName = trim($data['custom_field_categories'] ?? '');
        $category = Category::where('name', $categoryName)->first();
        $category_id = $category ? $category->id : 203;
        while (($row = fgetcsv($file)) !== false) {
            if (count($row) !== count($header) || empty(array_filter($row))) {
                continue;
            }
            $data = array_combine($header, $row);
            // Skip if email exists
            if (Customer::where('email', $data['email'])->exists()) {
                continue;
            }
            
            // Map plan_type
            $planTypeMap = ['FREE' => 1, 'STANDARD' => 2, 'PREMIUM' => 3];
            $plan_type = $planTypeMap[strtoupper(trim($data['plan_type']))] ?? 1;
            
            // Clean username
            $username = str_replace(['@', '.'], '-', $data['username'] ?? '');
            $username = str_replace(' ', '', $username);

            // Country & mobile code
            $billing_country = strtoupper(trim($data['billing_country'] ?? ''));
            $mobile_no_ic = $billing_country;
            $mobile_no_cc = $countryCodeMap[$billing_country] ?? '';

            $userRegisteredStr = trim(preg_replace('/\s+/', ' ', $data['user_registered'] ?? ''));

            $registeredAt = null;

            try {
                $registeredAt = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $userRegisteredStr);
                if (!$registeredAt || !$registeredAt->isValid()) {
                    throw new \Exception("Invalid date");
                }
            
                Customer::create([
                    'first_name'         => $data['first_name'] ?? '',
                    'last_name'          => $data['last_name'] ?? '',
                    'email'              => $data['email'],
                    'password'           => Hash::make('123456'),
                    'username'           => $username,
                    'plan_type'          => $plan_type,
                    'company_name'       => $data['company_name'] ?? '',
                    'company_address'    => $data['address'] ?? '',
                    'trn_no'             => $data['billing_gst_number'] ?? '',
                    'mobile_no'          => $data['billing_phone'] ?? '',
                    'mobile_no_ic'       => $mobile_no_ic,
                    'mobile_no_cc'       => $mobile_no_cc,
                    'category_id'        => $category_id,
                    'plan_started_at'    => $registeredAt->format('Y-m-d'),
                    'plan_expired_at'    => $registeredAt->copy()->addYear()->format('Y-m-d'),
                    'is_active'          => 1,
                    'is_deleted'         => 0,
                    'created_at'         => $registeredAt->format('Y-m-d H:i:s')
                ]);
            } catch (\Exception $e) {
                \Log::warning("Invalid user_registered value: " . $userRegisteredStr);
                continue; // Skip this row
            }
            
        }

        fclose($file);

        return response()->json(['message' => 'Customers imported successfully.']);
    }

}

