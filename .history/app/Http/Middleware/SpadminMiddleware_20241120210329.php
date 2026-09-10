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
        // Kiểm tra đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect('/spadmin/login')->with('error', 'Please login first.');
        }

        // Kiểm tra role có phải là spadmin không
        if (Auth::user()->role !== 'spadmin') {
            Auth::logout();
            return redirect('/')->with('error', 'You do not have permission to access this area.');
        }

        return $next($request);
    }
}
