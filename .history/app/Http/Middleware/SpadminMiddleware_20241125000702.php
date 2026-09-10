<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpadminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('spadmin')->check()) {
            return redirect()->route('spadmin.login');
        }

        if (Auth::guard('spadmin')->user()->role !== 'spadmin') {
            Auth::guard('spadmin')->logout();
            return redirect()->route('spadmin.login')
                ->with('error', 'Chỉ Super Admin mới có quyền truy cập.');
        }

        return $next($request);
    }
}
