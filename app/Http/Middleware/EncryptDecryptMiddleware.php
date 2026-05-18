<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Symfony\Component\HttpFoundation\Response;

class EncryptDecryptMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (env('USE_ENCRYPTION')) {
            $key = base64_decode(env('FRONTEND_SECRET_KEY'));
            $iv = base64_decode(env('FRONTEND_SECRET_IV'));

            // Validate key and IV
            if (!$key || !$iv || strlen($iv) !== 16) {
                abort(500, 'Invalid encryption key or IV.');
            }

            // Decrypt incoming request
            if ($request->has('data')) {
                try {
                    $cipherText = $request->get('data');

                    $decrypted = openssl_decrypt(
                        base64_decode($cipherText),
                        'AES-256-CBC',
                        $key,
                        OPENSSL_RAW_DATA,
                        $iv
                    );

                    $jsonData = json_decode($decrypted, true);

                    if (is_array($jsonData)) {
                        $request->merge($jsonData);
                    }
                } catch (\Throwable $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Decryption failed.',
                    ], 400);
                }
            }
        }

        $response = $next($request);

        if (
            env('USE_ENCRYPTION') &&
            Str::contains($response->headers->get('Content-Type'), 'application/json')
        ) {
            $key = base64_decode(env('FRONTEND_SECRET_KEY'));
            $iv = base64_decode(env('FRONTEND_SECRET_IV'));

            if (!$key || !$iv || strlen($iv) !== 16) {
                abort(500, 'Invalid encryption key or IV.');
            }

            $original = json_decode($response->getContent(), true);

            if (is_array($original)) {
                $encrypted = base64_encode(openssl_encrypt(
                    json_encode($original),
                    'AES-256-CBC',
                    $key,
                    OPENSSL_RAW_DATA,
                    $iv
                ));

                return response()->json(['data' => $encrypted], $response->getStatusCode());
            }
        }

        return $response;
    }
}
