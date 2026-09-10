<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Xử lý yêu cầu đăng nhập
     * 
     * @param LoginRequest $request Request chứa thông tin đăng nhập
     * @return RedirectResponse Chuyển hướng sau khi đăng nhập
     */
    public function store(LoginRequest $request)
    {
        // Xác thực thông tin đăng nhập
        $request->authenticate();
        
        // Tạo session mới để tránh session fixation
        $request->session()->regenerate();

        // Kiểm tra role và chuyển hướng tương ứng
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->role === 'superadmin') {
            return redirect()->route('superadmin.dashboard');
        }
        return redirect()->route('user.dashboard');
    }

    /**
     * Đăng xuất người dùng
     */
    public function destroy(Request $request)
    {
        // Đăng xuất người dùng hiện tại
        Auth::guard('web')->logout();

        // Hủy session hiện tại
        $request->session()->invalidate();

        // Tạo token mới
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
