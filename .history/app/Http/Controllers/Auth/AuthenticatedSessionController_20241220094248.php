<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

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
        try {
            $request->authenticate();
            $request->session()->regenerate();
            
            // Trả về response thành công với URL redirect
            $redirectUrl = match(Auth::user()->role) {
                'spadmin' => '/spadmin/dashboard',
                'admin' => '/admin/dashboard',
                default => '/'
            };
            
            return response()->json([
                'success' => true,
                'redirect' => $redirectUrl
            ]);
            
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        }
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

    // protected function authenticated(Request $request, $user)
    // {
    //     switch($user->role) {
    //         case 'admin':
    //             return redirect('/admin/dashboard');
    //         case 'spadmin':
    //             return redirect('/spadmin/dashboard');
    //         default:
    //             return redirect('/'); // User thường về trang chủ
    //     }
    // }
}
