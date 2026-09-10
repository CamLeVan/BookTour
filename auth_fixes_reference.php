<?php

/* ==============================================================================
 * TỆP THAM KHẢO SỬA LỖI LOGIC ĐĂNG NHẬP / ĐĂNG KÝ
 * File này chỉ chứa code tham khảo đã được comment để không ảnh hưởng đến dự án.
 * Bạn có thể copy từng đoạn tương ứng đắp vào các file thực tế khi cần.
 * ============================================================================== */


/* 
--------------------------------------------------------------------------------
1. SỬA LỖI BẢO MẬT: BẶT BUỘC KIỂM TRA TRẠNG THÁI (STATUS) KHI ĐĂNG NHẬP
- File cần sửa: app/Http/Requests/Auth/LoginRequest.php
- Vị trí: Trong hàm authenticate()
--------------------------------------------------------------------------------
*/

/*
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // [SỬA LỖI Ở ĐÂY] Thêm điều kiện 'status' => 'active' để chặn user inactive
        $credentials = $this->only('email', 'password');
        $credentials['status'] = 'active'; 

        if (! Auth::guard('web')->attempt($credentials, $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed') . ' (Hoặc tài khoản của bạn đã bị khóa)',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }
*/


/* 
--------------------------------------------------------------------------------
2 & 3. SỬA LỖI GỬI EMAIL XÁC THỰC VÀ REDIRECT SAU KHI ĐĂNG KÝ
- File cần sửa 1: app/Http/Controllers/Auth/RegisteredUserController.php
- File cần sửa 2 (JS): resources/views/auth/register.blade.php
--------------------------------------------------------------------------------
*/

/*
    // --- Trong app/Http/Controllers/Auth/RegisteredUserController.php (Hàm store) ---
    public function store(Request $request)
    {
        // ... code validation ...

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'status' => 'active'
        ]);

        // [SỬA LỖI 3] Kích hoạt event để gửi email xác thực
        event(new \Illuminate\Auth\Events\Registered($user));

        Auth::login($user);

        // Trả về response JSON (Cần JS bên frontend xử lý redirect)
        return response()->json([
            'message' => 'Đăng ký thành công! Vui lòng kiểm tra email để xác thực.',
            'redirect' => '/' // Trả kèm URL redirect để Frontend biết đường dẫn
        ]);
    }
*/

/*
    <!-- --- Trong resources/views/auth/register.blade.php (Đoạn mã JS xử lý form) --- -->
    <script>
        // ...
        $.ajax({
            url: '{{ route('register') }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                toastr.success(response.message, "Thông báo");
                
                // [SỬA LỖI 2] Bắt buộc trình duyệt redirect (hoặc reload) để cập nhật UI 
                window.location.href = response.redirect || '/';
            },
            // ...
        });
    </script>
*/


/* 
--------------------------------------------------------------------------------
4. SỬA LỖI GHI ĐÈ ROUTE XÁC THỰC EMAIL
- File cần sửa: routes/web.php
--------------------------------------------------------------------------------
*/

/*
    // BẠN CẦN TÌM VÀ XÓA BỎ ĐOẠN CODE SAU KHỎI routes/web.php:
    // Vì nó ghi đè route thật của hệ thống từ thư mục auth.php

    // XÓA ĐOẠN NÀY:
    // Route::get('/email/verify/{id}/{hash}', function (Request $request) {
    //     // Email verification logic
    // })->middleware(['auth', 'signed'])->name('verification.verify');
*/


/* 
--------------------------------------------------------------------------------
5. SỬA LỖI QUÊN MẬT KHẨU (AJAX TRẢ VỀ SAI ĐỊNH DẠNG)
- File cần sửa: app/Http/Controllers/Auth/PasswordResetLinkController.php
- Vị trí: Trong hàm store()
--------------------------------------------------------------------------------
*/

/*
    public function store(Request $request) //: RedirectResponse (có thể bỏ type hint này)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        // [SỬA LỖI 5] Hỗ trợ trả về JSON nếu request là AJAX (ví dụ fetch() từ frontend)
        if ($request->wantsJson()) {
            if ($status == Password::RESET_LINK_SENT) {
                return response()->json([
                    'status' => 'success', 
                    'message' => __($status)
                ]);
            }

            return response()->json([
                'status' => 'error', 
                'message' => __($status)
            ], 422);
        }

        // Dành cho request submit form thông thường không qua AJAX
        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
*/

?>
