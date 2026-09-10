<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SpadminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Debug để xem middleware có chạy không
        dd([
            'middleware_running' => true,
            'user' => Auth::user(),
            'role' => Auth::user()->role
        ]);

        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->role !== 'spadmin') {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
