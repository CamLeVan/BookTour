<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\Cache\RateLimiter;

class PasswordResetController extends Controller
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Rate limiting
        $key = 'password_reset.' . $request->ip();
        if ($this->limiter->tooManyAttempts($key, 3)) { // 3 lần/giờ
            return back()->withErrors([
                'email' => 'Quá nhiều yêu cầu. Vui lòng thử lại sau.'
            ]);
        }

        // Logging
        Log::channel('auth')->info('Password reset requested', [
            'email' => $request->email,
            'ip' => $request->ip()
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        $this->limiter->hit($key, 3600); // 1 giờ

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
} 