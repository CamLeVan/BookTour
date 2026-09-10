<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckFrontend
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'admin' || $user->role === 'spadmin') {
                // Logout
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                // Redirect về trang chủ với thông báo
                return redirect('/')->with('warning', 'Bạn đã đăng xuất khỏi tài khoản admin/spadmin để truy cập trang người dùng');
            }
        }
        return $next($request);
    }
}
