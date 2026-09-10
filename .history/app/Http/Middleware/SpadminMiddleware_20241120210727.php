<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpadminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/spadmin/login');
        }

        if (Auth::user()->role !== 'spadmin') {
            Auth::logout();
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
