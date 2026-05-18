<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCustomerSession
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('customer-api')->user();

        if ($user && Auth::guard('customer-api')->check()) {
            if ($user->session_id !== Auth::guard('customer-api')->user()->session_id) {
                $user->tokens()->delete();
                return response()->json(['message' => 'Session expired. Please log in again.'], 401);
            }
        }


        return $next($request);
    }
}

