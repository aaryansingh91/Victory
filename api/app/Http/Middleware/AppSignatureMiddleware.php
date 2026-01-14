<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AppSignatureMiddleware
{
    /**
     * ✅ Apni app ka valid signature
     */
    private $VALID_SIGNATURE = "v3/DbvAkY6dUCv1KEUgmSY3IgMJ/ANDypVphFIDVknc=";

    /**
     * ✅ Apni app ka valid package name
     */
    private $VALID_PACKAGE = "com.app.gameaura";

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $appSignature = $request->header('X-App-Signature');
        $packageName  = $request->header('X-Package-Name');

        // Check 1: Signature missing
        if (!$appSignature) {
            Log::warning('❌ App Signature Missing', [
                'received_signature' => $appSignature,
                'received_package'   => $packageName
            ]);
            return $this->unauthorizedResponse();
        }

        // Check 2: Signature mismatch
        if ($appSignature !== $this->VALID_SIGNATURE) {
            Log::warning('❌ Invalid App Signature', [
                'received_signature' => $appSignature,
                'expected_signature' => $this->VALID_SIGNATURE,
                'received_package'   => $packageName
            ]);
            return $this->unauthorizedResponse();
        }

        // Check 3: Package name missing
        if (!$packageName) {
            Log::warning('❌ Package Name Missing', [
                'received_signature' => $appSignature,
                'received_package'   => $packageName
            ]);
            return $this->unauthorizedResponse();
        }

        // Check 4: Package name mismatch
        if ($packageName !== $this->VALID_PACKAGE) {
            Log::warning('❌ Invalid Package Name', [
                'received_package'   => $packageName,
                'expected_package'   => $this->VALID_PACKAGE,
                'received_signature' => $appSignature
            ]);
            return $this->unauthorizedResponse();
        }

        // ✅ All checks passed — allow request
        return $next($request);
    }

    /**
     * Common unauthorized response helper
     */
    private function unauthorizedResponse()
    {
        return response()->json([
            'success' => false,
            'error'   => 'Unauthorized',
            'message' => 'Internal Server Error'
        ], 403);
    }
}
