<nav class="navbar navbar-expand-lg">
    <div class="container">
        <!-- Logo -->
        <div class="logo-wrapper navbar-brand">
            <a class="logo" href="{{ route('frontend.home') }}">
                <h2>HC Travel</h2>
            </a>
        </div>
        
        <!-- Navigation -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('frontend.home') ? 'active' : '' }}" 
                       href="{{ route('frontend.home') }}">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('frontend.about') ? 'active' : '' }}" 
                       href="{{ route('frontend.about') }}">Giới thiệu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('frontend.tours.*') ? 'active' : '' }}" 
                       href="{{ route('frontend.tours.index') }}">Tour du lịch</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('frontend.blog.*') ? 'active' : '' }}" 
                       href="{{ route('frontend.blog.index') }}">Tin tức</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('frontend.contact') ? 'active' : '' }}" 
                       href="{{ route('frontend.contact') }}">Liên hệ</a>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <div class="d-flex align-items-center">
                                <img src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('assets/images/users/default-avatar.jpg') }}" 
                                     alt="{{ Auth::user()->name }}"
                                     class="rounded-circle"
                                     style="width: 35px; height: 35px; object-fit: cover;">
                                <span class="ms-2">{{ Auth::user()->name }}</span>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                                <i class="fas fa-user me-2"></i>Thông tin cá nhân
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('frontend.bookings.history') }}">
                                <i class="fas fa-history me-2"></i>Lịch sử đặt tour
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Đăng nhập</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Đăng ký</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Login Modal -->
<div class="modal fade auth-modal" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Welcome Back! 👋</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <!-- Error Message -->
                    <div class="alert alert-danger error-message" style="display: none;"></div>
                    
                    <p class="text-muted mb-4">Vui lòng đăng nhập để tiếp tục</p>

                    <!-- Email Input -->
                    <div class="form-group custom-input-group mb-3">
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" 
                                   class="form-control" 
                                   id="email" 
                                   name="email" 
                                   placeholder="Email của bạn"
                                   required>
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="form-group custom-input-group mb-4">
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" 
                                   class="form-control" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Mật khẩu"
                                   required>
                        </div>
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                            <label class="form-check-label" for="remember_me">Ghi nhớ đăng nhập</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="#" 
                               class="forgot-link"
                               data-bs-toggle="modal" 
                               data-bs-target="#forgotPasswordModal" 
                               onclick="$('#loginModal').modal('hide')">
                                Quên mật khẩu?
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn btn-primary w-100 login-btn">
                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                        <span class="btn-text">Đăng nhập</span>
                    </button>

                    <!-- Register Link -->
                    <div class="text-center mt-4">
                        <p class="mb-0">Chưa có tài khoản? 
                            <a href="#" 
                               class="register-link"
                               data-bs-toggle="modal" 
                               data-bs-target="#registerModal">
                                Đăng ký ngay
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade auth-modal" id="registerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 bg-success text-white">
                <h5 class="modal-title">Đăng ký tài khoản</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Thêm validation errors từ Breeze -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/logo-b.png') }}" alt="Logo" height="60">
                        <p class="text-muted mt-2">Tạo tài khoản mới</p>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" placeholder="Họ và tên"
                               value="{{ old('name') }}" required autofocus>
                        <label for="name">Họ và tên</label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="register_email" name="email" placeholder="name@example.com"
                               value="{{ old('email') }}" required>
                        <label for="register_email">Email</label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="register_password" name="password" placeholder="Password" required>
                        <label for="register_password">Mật khẩu</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" class="form-control"
                               id="password_confirmation" name="password_confirmation" 
                               placeholder="Confirm Password" required>
                        <label for="password_confirmation">Xác nhận mật khẩu</label>
                    </div>

                    <button type="submit" class="btn btn-success w-100 py-2 mb-3">
                        <i class="fas fa-user-plus me-2"></i>Đăng ký
                    </button>

                    <div class="text-center">
                        <p class="text-muted">Đã có tài khoản? 
                            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="text-success">
                                ����ăng nhập
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 bg-info text-white">
                <h5 class="modal-title">Thông tin cá nhân</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                @if(Auth::check())
                    <!-- Thêm session status message từ Breeze -->
                    @if (session('status') === 'profile-updated')
                        <div class="alert alert-success mb-3">
                            {{ __('Profile updated successfully.') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        
                        <div class="text-center mb-4">
                            <div class="avatar-upload mb-3 position-relative">
                                <img src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('assets/images/users/default-avatar.jpg') }}" 
                                     alt="{{ Auth::user()->name }}" 
                                     class="rounded-circle" 
                                     style="width: 100px; height: 100px; object-fit: cover;"
                                     id="preview-avatar">
                                <label for="avatar" class="position-absolute bottom-0 end-0 bg-white rounded-circle p-2 shadow-sm" style="cursor: pointer;">
                                    <i class="fas fa-camera text-primary"></i>
                                    <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*" onchange="previewImage(this)">
                                </label>
                            </div>
                            <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                            <p class="text-muted">Thành viên từ {{ Auth::user()->created_at->format('d/m/Y') }}</p>
                            
                            <!-- Thêm nút Đổi ảnh đại diện -->
                            <button type="button" class="btn btn-outline-primary btn-sm mt-2" onclick="document.getElementById('avatar').click()">
                                <i class="fas fa-camera me-2"></i>Đổi ảnh đại diện
                            </button>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="profile_name" name="name" placeholder="Họ và tên"
                                   value="{{ old('name', Auth::user()->name) }}" required>
                            <label for="profile_name">Họ và tên</label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="profile_email" name="email" placeholder="name@example.com"
                                   value="{{ old('email', Auth::user()->email) }}" required>
                            <label for="profile_email">Email</label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-info w-100 mb-3">
                            <i class="fas fa-save me-2"></i>Cập nhật thông tin
                        </button>
                    </form>

                    <!-- Password Update Form -->
                    <form method="POST" action="{{ route('password.update') }}" class="mt-4 pt-4 border-top">
                        @csrf
                        @method('put')
                        
                        <h5 class="mb-3">Đổi mật khẩu</h5>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                   id="current_password" name="current_password" 
                                   placeholder="Mật khẩu hiện tại" required>
                            <label for="current_password">Mật khẩu hiện tại</label>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="new_password" name="password" 
                                   placeholder="Mật khẩu mới" required>
                            <label for="new_password">Mật khẩu mới</label>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control"
                                   id="password_confirmation" name="password_confirmation" 
                                   placeholder="Xác nhận mật khẩu mới" required>
                            <label for="password_confirmation">Xác nhận mật khẩu mới</label>
                        </div>

                        <button type="submit" class="btn btn-warning w-100 mb-3">
                            <i class="fas fa-key me-2"></i>Cập nhật mật khẩu
                        </button>
                    </form>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-sign-out-alt me-2"></i> Đăng Xuất
                        </button>
                    </form>
                @else
                    <div class="text-center py-4">
                        <p class="mb-3">Vui lòng đăng nhập để xem thông tin cá nhân</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Forgot Password Modal -->
<div class="modal fade auth-modal" id="forgotPasswordModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 position-relative bg-gradient">
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-warning opacity-10"></div>
                <h5 class="modal-title position-relative text-dark fw-bold">Quên mật khẩu?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('password.email') }}" id="forgotPasswordForm">
                    @csrf
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/logo-b.png') }}" alt="Logo" height="60" class="mb-3">
                        <p class="text-muted">Nhập email của bạn để nhận link đặt lại mật khẩu</p>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control custom-input @error('email') is-invalid @enderror" 
                               id="forgot_email" name="email" placeholder="name@example.com" required>
                        <label for="forgot_email"><i class="fas fa-envelope me-2"></i>Email Address</label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-2 mb-3 btn-elevated">
                        <i class="fas fa-paper-plane me-2"></i>Gửi link đặt lại mật khẩu
                    </button>

                    <div class="text-center">
                        <p class="text-muted">Đã nhớ mật khẩu? 
                            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="text-warning fw-bold">
                                Đăng nhập
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 position-relative bg-gradient">
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-info opacity-10"></div>
                <h5 class="modal-title position-relative text-dark fw-bold">Đặt lại mật khẩu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('password.update') }}" id="resetPasswordForm">
                    @csrf
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">
                    
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/logo-b.png') }}" alt="Logo" height="60" class="mb-3">
                        <p class="text-muted">Tạo mật khẩu mới cho tài khoản của bạn</p>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control custom-input" 
                               id="reset_email" name="email" value="{{ request()->email }}" readonly>
                        <label for="reset_email"><i class="fas fa-envelope me-2"></i>Email Address</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control custom-input @error('password') is-invalid @enderror"
                               id="reset_password" name="password" placeholder="New Password" required>
                        <label for="reset_password"><i class="fas fa-lock me-2"></i>Mật khẩu mới</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" class="form-control custom-input"
                               id="reset_password_confirmation" name="password_confirmation" 
                               placeholder="Confirm Password" required>
                        <label for="reset_password_confirmation"><i class="fas fa-lock me-2"></i>Xác nhận mật khẩu</label>
                    </div>

                    <button type="submit" class="btn btn-info w-100 py-2 mb-3 btn-elevated">
                        <i class="fas fa-key me-2"></i>Đặt lại mật khẩu
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Thêm styles -->
@push('styles')
<style>
    .auth-modal .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .auth-modal .modal-header {
        padding: 2rem 2rem 1rem;
    }

    .auth-modal .modal-title {
        font-size: 1.5rem;
        color: #2d3436;
    }

    .auth-modal .modal-body {
        padding: 2rem;
    }

    /* Custom Input Style */
    .custom-input-group {
        position: relative;
    }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon i {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0a0a0;
        transition: all 0.3s;
    }

    .custom-input-group .form-control {
        height: 54px;
        padding: 0.75rem 1rem 0.75rem 3rem;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .custom-input-group .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.1);
        background: #fff;
    }

    .custom-input-group .form-control:focus + i {
        color: #007bff;
    }

    /* Custom Checkbox */
    .custom-checkbox .form-check-input {
        width: 1.2em;
        height: 1.2em;
        border-radius: 6px;
        border: 2px solid #e9ecef;
    }

    .custom-checkbox .form-check-input:checked {
        background-color: #007bff;
        border-color: #007bff;
    }

    .custom-checkbox .form-check-label {
        color: #6c757d;
        padding-left: 0.5rem;
    }

    /* Links */
    .forgot-link, .register-link {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
        position: relative;
        transition: all 0.3s ease;
        padding-bottom: 2px;
    }

    .forgot-link::after, .register-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 0;
        background: linear-gradient(45deg, #007bff, #00a1ff);
        transition: width 0.3s ease;
    }

    .forgot-link:hover, .register-link:hover {
        color: #0056b3;
        text-decoration: none;
    }

    .forgot-link:hover::after, .register-link:hover::after {
        width: 100%;
    }

    /* Login Button */
    .login-btn {
        height: 54px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        background: linear-gradient(45deg, #007bff, #00a1ff);
        border: none;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .login-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, #00a1ff, #007bff);
        transition: left 0.3s ease;
        z-index: -1;
    }

    .login-btn:hover::before {
        left: 0;
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 123, 255, 0.2);
    }

    /* Error Message */
    .error-message {
        border-radius: 12px;
        border-left: 4px solid #e53e3e;
        background: #fff5f5;
        color: #e53e3e;
        font-size: 0.9rem;
        padding: 1rem;
        animation: shake 0.5s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
    }

    @keyframes shake {
        10%, 90% { transform: translateX(-1px); }
        20%, 80% { transform: translateX(2px); }
        30%, 50%, 70% { transform: translateX(-4px); }
        40%, 60% { transform: translateX(4px); }
    }

    /* Animation */
    .auth-modal .modal-content {
        animation: modalSlide 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes modalSlide {
        from {
            opacity: 0;
            transform: translateY(-60px) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* Responsive */
    @media (max-width: 576px) {
        .auth-modal .modal-body {
            padding: 1.5rem;
        }
        
        .auth-modal .modal-title {
            font-size: 1.25rem;
        }
    }
</style>
@endpush

<!-- Thêm Font Awesome cho icons -->
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
// Cấu hình toastr
toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
}

function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            // Hiển thị preview
            document.getElementById('preview-avatar').src = e.target.result;
            
            // Tạo form data
            var formData = new FormData();
            formData.append('avatar', input.files[0]);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('_method', 'PATCH');
            
            // Upload avatar
            fetch('{{ route('profile.update') }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Cập nhật avatar trong navigation
                    document.querySelector('.nav-link.dropdown-toggle img').src = e.target.result;
                    
                    // Hiển thị thông báo thành công
                    toastr.success('Cập nhật ảnh đại diện thành công!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                toastr.error('Có lỗi xảy ra khi cập nhật ảnh đại diện!');
            });
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function() {
    // Xử lý form update profile
    $('#updateProfileForm').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        const submitBtn = $('#updateProfileBtn');
        const btnText = submitBtn.find('.btn-text');
        const btnLoader = submitBtn.find('.btn-loader');
        
        // Reset previous error states
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').empty();
        
        // Disable button and show loading state
        submitBtn.prop('disabled', true);
        btnText.addClass('d-none');
        btnLoader.removeClass('d-none');
        
        // Create FormData object
        const formData = new FormData(form[0]);
        formData.append('_method', 'PATCH');
        
        fetch(form.attr('action'), {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Update navbar username
                $('.nav-link.dropdown-toggle span').text(data.user.name);
                
                // Hiển thị thông báo thành công
                toastr.success('Cập nhật thông tin thành công!');
                
                // Close modal using Bootstrap 5 method
                const modalElement = document.getElementById('profileModal');
                const modal = bootstrap.Modal.getInstance(modalElement);
                modal.hide();
            }
        })
        .catch(error => {
            if (error.response && error.response.status === 422) {
                const errors = error.response.data.errors;
                Object.keys(errors).forEach(field => {
                    $(`#${field}`).addClass('is-invalid');
                    $(`#${field}Error`).text(errors[field][0]);
                });
            }
            toastr.error('Có lỗi xảy ra khi cập nhật thông tin!');
        })
        .finally(() => {
            // Reset button state
            submitBtn.prop('disabled', false);
            btnText.removeClass('d-none');
            btnLoader.addClass('d-none');
        });
    });
});
</script>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý form quên mật khẩu
    const forgotPasswordForm = document.getElementById('forgotPasswordForm');
    if (forgotPasswordForm) {
        forgotPasswordForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    toastr.success('Link đặt lại mật khẩu đã được gửi đến email của bạn!');
                    $('#forgotPasswordModal').modal('hide');
                } else {
                    toastr.error(data.message || 'Có lỗi xảy ra, vui lòng thử lại!');
                }
            })
            .catch(error => {
                toastr.error('Có lỗi xảy ra, vui lòng thử lại!');
            });
        });
    }

    // Hiển thị modal reset password nếu có token
    @if(request()->route('token'))
        $('#resetPasswordModal').modal('show');
    @endif
});
</script>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        const submitBtn = form.find('button[type="submit"]');
        const btnText = submitBtn.find('.btn-text');
        const spinner = submitBtn.find('.spinner-border');
        const errorDiv = form.find('.error-message');
        
        // Reset error states
        form.find('.is-invalid').removeClass('is-invalid');
        errorDiv.hide();
        
        // Disable button and show loading
        submitBtn.prop('disabled', true);
        btnText.text('Đang xử lý...');
        spinner.removeClass('d-none');
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    window.location.href = response.redirect;
                }
            },
            error: function(xhr) {
                // Enable button
                submitBtn.prop('disabled', false);
                btnText.text('Đăng nhập');
                spinner.addClass('d-none');
                
                if (xhr.status === 422) {
                    // Validation errors
                    const errors = xhr.responseJSON.errors;
                    let errorMessages = [];
                    
                    for (let field in errors) {
                        errorMessages.push(errors[field][0]);
                        $(`#${field}`).addClass('is-invalid');
                    }
                    
                    errorDiv.html(errorMessages.join('<br>')).show();
                    // Thêm thông báo bằng toastr
                    toastr.error(errorMessages.join('<br>'));
                }
            }
        });
    });
});
</script>
@endpush
