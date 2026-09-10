<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidatePaymentWebhook
{
    public function handle(Request $request, Closure $next)
    {
        // Validate webhook signature
        $signature = $request->header('X-Webhook-Signature');
        
        if (!$this->validateSignature($signature, $request->getContent())) {
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        return $next($request);
    }

    protected function validateSignature($signature, $payload): bool
    {
        $expectedSignature = hash_hmac('sha256', $payload, config('services.vietqr.webhook_secret'));
        return hash_equals($expectedSignature, $signature);
    }
} 