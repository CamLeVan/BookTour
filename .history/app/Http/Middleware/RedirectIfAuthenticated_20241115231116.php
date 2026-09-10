<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class RedirectIfAuthenticated
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

            // Check if the user is authenticated
            if (Auth::guard($guard && Route::is('super-admin.*'))->check()) {
                #SuperAdmin
                if ($guard == 'superadmin') {
                    return redirect()->route('superadmin.dashboard');
                }
                #Admin
                elseif (Auth::guard($guard && Route::is('admin.*'))->check()) {
                    return redirect()->route('admin.dashboard');
                }
                #Normal User
                else {
                    return redirect()->route('dashboard');
                }
            }
        }

        return $next($request);
    }
}
