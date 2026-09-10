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
            <div class="modal-header border-0 bg-primary text-white">
                <h5 class="modal-title">Đăng nhập</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/logo-b.png') }}" alt="Logo" height="60">
                        <p class="text-muted mt-2">Chào mừng bạn quay trở lại!</p>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" placeholder="name@example.com"
                               value="{{ old('email') }}" required autofocus>
                        <label for="email">Email</label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" placeholder="Password" required>
                        <label for="password">Mật khẩu</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                            <label class="form-check-label" for="remember_me">Ghi nhớ đăng nhập</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" 
                               class="text-primary text-decoration-none"
                               onclick="$('#loginModal').modal('hide')">
                                Quên mật khẩu?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                        <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập
                    </button>

                    <div class="text-center">
                        <p class="text-muted">Chưa có tài khoản? 
                            <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" class="text-primary">
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
                                Đăng nhập
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
    /* Modern Glass-morphism Modal Styles */
    .auth-modal .modal-content {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }

    .auth-modal .modal-header {
        background: linear-gradient(135deg, #00B4DB 0%, #0083B0 100%);
        padding: 2rem;
        border: none;
        border-radius: 24px 24px 0 0;
        position: relative;
        overflow: hidden;
    }

    .auth-modal .modal-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 50%);
        animation: rotate 15s linear infinite;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .auth-modal .modal-title {
        color: #fff;
        font-weight: 700;
        font-size: 1.75rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        position: relative;
    }

    .auth-modal .modal-body {
        padding: 2.5rem;
    }

    /* Sophisticated Form Controls */
    .auth-modal .form-floating {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .auth-modal .form-control {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(0, 180, 219, 0.1);
        border-radius: 16px;
        padding: 1.2rem 1rem;
        height: 60px;
        font-size: 1rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .auth-modal .form-control:focus {
        border-color: #00B4DB;
        box-shadow: 0 8px 16px -4px rgba(0, 180, 219, 0.15);
        transform: translateY(-2px);
    }

    .auth-modal .form-floating label {
        padding: 1rem;
        color: #64748b;
        font-weight: 500;
    }

    .auth-modal .form-floating > .form-control:focus ~ label,
    .auth-modal .form-floating > .form-control:not(:placeholder-shown) ~ label {
        color: #00B4DB;
        transform: scale(0.85) translateY(-1rem) translateX(0.15rem);
    }

    /* Modern Buttons */
    .auth-modal .btn-auth {
        height: 56px;
        border-radius: 16px;
        font-weight: 600;
        font-size: 1.1rem;
        text-transform: none;
        letter-spacing: 0.5px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        padding: 0 2rem;
    }

    .auth-modal .btn-login {
        background: linear-gradient(135deg, #00B4DB 0%, #0083B0 100%);
        color: white;
        border: none;
        box-shadow: 0 10px 20px -5px rgba(0, 180, 219, 0.3);
    }

    .auth-modal .btn-register {
        background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
        color: white;
        border: none;
        box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.3);
    }

    .auth-modal .btn-forgot {
        background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%);
        color: white;
        border: none;
        box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.3);
    }

    .auth-modal .btn-auth:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Social Login Buttons */
    .auth-modal .social-login-divider {
        position: relative;
        text-align: center;
        margin: 2rem 0;
    }

    .auth-modal .social-login-divider::before,
    .auth-modal .social-login-divider::after {
        content: '';
        position: absolute;
        top: 50%;
        width: calc(50% - 30px);
        height: 1px;
        background: rgba(0, 0, 0, 0.1);
    }

    .auth-modal .social-login-divider::before { left: 0; }
    .auth-modal .social-login-divider::after { right: 0; }

    .auth-modal .social-login-divider span {
        background: white;
        padding: 0 1rem;
        color: #64748b;
        font-weight: 500;
    }

    .auth-modal .social-login {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-top: 1rem;
    }

    .auth-modal .social-btn {
        background: white;
        border: 2px solid rgba(0, 0, 0, 0.1);
        border-radius: 16px;
        padding: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        font-weight: 500;
        color: #1f2937;
        transition: all 0.3s ease;
    }

    .auth-modal .social-btn:hover {
        background: #f8fafc;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    /* Custom Checkbox */
    .auth-modal .custom-checkbox {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        user-select: none;
    }

    .auth-modal .custom-checkbox input {
        display: none;
    }

    .auth-modal .checkmark {
        width: 24px;
        height: 24px;
        border: 2px solid rgba(0, 180, 219, 0.2);
        border-radius: 8px;
        position: relative;
        transition: all 0.3s ease;
    }

    .auth-modal .custom-checkbox input:checked ~ .checkmark {
        background: #00B4DB;
        border-color: #00B4DB;
    }

    .auth-modal .checkmark::after {
        content: '';
        position: absolute;
        top: 45%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        width: 12px;
        height: 12px;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white'%3E%3Cpath d='M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z'/%3E%3C/svg%3E") center/contain no-repeat;
        transition: all 0.3s ease;
    }

    .auth-modal .custom-checkbox input:checked ~ .checkmark::after {
        transform: translate(-50%, -50%) scale(1);
    }

    /* Links */
    .auth-modal .auth-link {
        color: #00B4DB;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .auth-modal .auth-link:hover {
        color: #0083B0;
        text-decoration: underline;
    }

    /* Animations */
    @keyframes slideUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .auth-modal .modal-dialog {
        animation: slideUp 0.4s ease-out;
    }

    /* Responsive Design */
    @media (max-width: 576px) {
        .auth-modal .modal-body {
            padding: 1.5rem;
        }

        .auth-modal .social-login {
            grid-template-columns: 1fr;
        }

        .auth-modal .btn-auth {
            height: 50px;
            font-size: 1rem;
        }
    }

    /* Error States */
    .auth-modal .is-invalid {
        border-color: #ef4444;
    }

    .auth-modal .invalid-feedback {
        font-size: 0.875rem;
        color: #ef4444;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .auth-modal .invalid-feedback::before {
        content: '⚠️';
        font-size: 1rem;
    }

    /* Loading States */
    .auth-modal .btn-loading {
        position: relative;
        color: transparent !important;
    }

    .auth-modal .btn-loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        border: 2px solid white;
        border-radius: 50%;
        border-top-color: transparent;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
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
