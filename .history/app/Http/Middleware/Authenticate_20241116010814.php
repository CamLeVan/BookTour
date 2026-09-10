<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\AuthenticationException;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::shouldUse($guard);
                return $next($request);
            }
        }
        throw new AuthenticationException('Unauthenticated', $guards, $this->redirectTo());
    }

    /**
     * Function to redirect to the login page
     */
    protected function redirectTo()
    {
        # For super admin
        if (Route::is('super-admin.*')) {
            return route('super-admin.login');
        }
        # For admin
        if (Route::is('admin.*')) {
            return route('admin.login');
        }
        return route('login');
    }
}
