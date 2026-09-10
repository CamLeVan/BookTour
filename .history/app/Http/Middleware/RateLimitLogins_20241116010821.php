<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RateLimitLogins
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    public function handle(Request $request, Closure $next): Response
    {
        // Giới hạn 5 lần/phút cho mỗi IP
        $key = 'login.' . $request->ip();
        
        if ($this->limiter->tooManyAttempts($key, 5)) {
            return response()->json([
                'message' => 'Quá nhiều lần thử. Vui lòng thử lại sau ' . 
                    $this->limiter->availableIn($key) . ' giây.'
            ], 429);
        }

        $this->limiter->hit($key, 60); // 60 giây

        return $next($request);
    }
} 