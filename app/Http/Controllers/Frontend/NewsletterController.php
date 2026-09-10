<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email'
        ]);

        // Thêm logic xử lý đăng ký newsletter ở đây
        // Ví dụ: lưu email vào database

        return back()->with('success', 'Đăng ký nhận tin thành công!');
    }
}