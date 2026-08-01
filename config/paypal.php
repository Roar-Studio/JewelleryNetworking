<?php

return [

    /*
    |--------------------------------------------------------------------------
    | PayPal Mode
    |--------------------------------------------------------------------------
    |
    | 'sandbox' or 'live'. Controls which credential set below is used and
    | which PayPal API environment (Sandbox vs Production) requests go to.
    |
    */

    'mode' => env('PAYPAL_MODE', 'sandbox'),

    'sandbox' => [
        'client_id'     => env('PAYPAL_SANDBOX_CLIENT_ID', ''),
        'client_secret' => env('PAYPAL_SANDBOX_CLIENT_SECRET', ''),
    ],

    'live' => [
        'client_id'     => env('PAYPAL_CLIENT_ID', ''),
        'client_secret' => env('PAYPAL_SECRET', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | PayPal Currency
    |--------------------------------------------------------------------------
    |
    | The Razorpay flow charges in INR. Many PayPal accounts registered in
    | India cannot settle INR directly, so the PayPal leg is kept on its own
    | currency setting rather than reusing the Razorpay INR amount as-is.
    | Set this to whatever currency your PayPal business account actually
    | settles in (commonly USD).
    |
    */

    'currency' => env('PAYPAL_CURRENCY', 'USD'),

    /*
    |--------------------------------------------------------------------------
    | PayPal Entry Fee
    |--------------------------------------------------------------------------
    |
    | If set, this overrides config('dda.entry_fee') specifically for the
    | PayPal flow so you can supply an already-converted amount in the
    | currency configured above (e.g. the USD equivalent of the INR fee).
    | Leave null to fall back to config('dda.entry_fee') as-is.
    |
    */

    'entry_fee' => env('PAYPAL_ENTRY_FEE', null),

    /*
    |--------------------------------------------------------------------------
    | Checkout Presentation
    |--------------------------------------------------------------------------
    */

    'brand_name' => env('PAYPAL_BRAND_NAME', 'Deities Design Awards'),

    'locale' => env('PAYPAL_LOCALE', 'en_US'),

];