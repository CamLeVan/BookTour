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
<div class="modal fade auth-modal premium-modal" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 overflow-hidden shadow-lg rounded-4">
            <div class="row g-0">
                <!-- Left Side: Image/Brand -->
                <div class="col-md-5 bg-image auth-sidebar d-none d-md-flex flex-column justify-content-between p-4" 
                     style="background-image: url('{{ asset('frontend/img/slider/15.jpg') }}'); background-size: cover; background-position: center; position: relative;">
                    <div class="overlay" style="position: absolute; top:0; left:0; right:0; bottom:0; background: linear-gradient(to bottom, rgba(32, 149, 174, 0.8), rgba(15, 36, 84, 0.9)); z-index: 1;"></div>
                    <div class="brand-top position-relative" style="z-index: 2;">
                        <a href="{{ route('frontend.home') }}" class="text-white text-decoration-none">
                            <h2 class="fw-bold mb-0" style="font-family: 'Poppins', sans-serif;">HC Travel</h2>
                        </a>
                    </div>
                    <div class="welcome-text position-relative text-white" style="z-index: 2;">
                        <h3 class="fw-bold mb-3">Khám phá thế giới!</h3>
                        <p class="mb-0 opacity-75">Đăng nhập để đặt tour, theo dõi hành trình và nhận các ưu đãi độc quyền.</p>
                    </div>
                </div>
                
                <!-- Right Side: Form -->
                <div class="col-md-7 p-4 p-md-5 bg-white">
                    <div class="d-flex justify-content-end mb-4">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="form-wrapper">
                        <h3 class="fw-bold text-dark mb-1">Chào mừng trở lại! 👋</h3>
                        <p class="text-muted mb-4">Vui lòng đăng nhập vào tài khoản của bạn</p>

                        <div class="alert alert-danger error-message rounded-3" style="display: none;"></div>

                        <form id="loginForm" method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <!-- Email Input -->
                            <div class="form-floating mb-3 custom-floating">
                                <input type="email" class="form-control" id="login_email" name="email" placeholder="name@example.com" required>
                                <label for="login_email"><i class="fas fa-envelope me-2 text-muted"></i>Địa chỉ Email</label>
                            </div>

                            <!-- Password Input -->
                            <div class="form-floating mb-4 custom-floating position-relative">
                                <input type="password" class="form-control pe-5" id="login_password" name="password" placeholder="Password" required>
                                <label for="login_password"><i class="fas fa-lock me-2 text-muted"></i>Mật khẩu</label>
                            </div>

                            <!-- Options -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check custom-checkbox">
                                    <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                                    <label class="form-check-label text-muted" for="remember_me">
                                        Ghi nhớ đăng nhập
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="#" class="text-decoration-none fw-semibold" style="color: #2095AE;" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" onclick="$('#loginModal').modal('hide')">
                                        Quên mật khẩu?
                                    </a>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold premium-btn mb-4">
                                <span class="spinner-border spinner-border-sm d-none me-2" role="status"></span>
                                <span class="btn-text">ĐĂNG NHẬP</span>
                            </button>

                            <!-- Register Link -->
                            <div class="text-center">
                                <p class="text-muted mb-0">Chưa có tài khoản? 
                                    <a href="#" class="fw-bold text-decoration-none ms-1" style="color: #2095AE;" data-bs-toggle="modal" data-bs-target="#registerModal">
                                        Đăng ký ngay
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade auth-modal premium-modal" id="registerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 overflow-hidden shadow-lg rounded-4">
            <div class="row g-0 flex-row-reverse">
                <!-- Right Side: Image/Brand -->
                <div class="col-md-5 bg-image auth-sidebar d-none d-md-flex flex-column justify-content-between p-4" 
                     style="background-image: url('{{ asset('frontend/img/slider/15.jpg') }}'); background-size: cover; background-position: center; position: relative;">
                    <div class="overlay" style="position: absolute; top:0; left:0; right:0; bottom:0; background: linear-gradient(to bottom, rgba(32, 149, 174, 0.8), rgba(15, 36, 84, 0.9)); z-index: 1;"></div>
                    <div class="brand-top position-relative text-end" style="z-index: 2;">
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="welcome-text position-relative text-white text-end" style="z-index: 2;">
                        <h3 class="fw-bold mb-3">Thành viên HC!</h3>
                        <p class="mb-0 opacity-75">Tạo tài khoản để trải nghiệm những chuyến đi tuyệt vời cùng HC Travel.</p>
                    </div>
                </div>
                
                <!-- Left Side: Form -->
                <div class="col-md-7 p-4 p-md-5 bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-4 d-md-none">
                        <h2 class="fw-bold mb-0" style="color: #2095AE; font-family: 'Poppins', sans-serif;">HC Travel</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="form-wrapper">
                        <h3 class="fw-bold text-dark mb-1">Đăng ký tài khoản</h3>
                        <p class="text-muted mb-4">Điền thông tin để bắt đầu hành trình của bạn</p>

                        <div class="alert alert-danger error-message rounded-3" style="display: none;"></div>

                        <form id="registerForm" method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            <div class="row">
                                <!-- Name Input -->
                                <div class="col-12 mb-3">
                                    <div class="form-floating custom-floating">
                                        <input type="text" class="form-control" id="reg_name" name="name" placeholder="Họ và tên" required>
                                        <label for="reg_name"><i class="fas fa-user me-2 text-muted"></i>Họ và tên</label>
                                    </div>
                                </div>

                                <!-- Email Input -->
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating custom-floating">
                                        <input type="email" class="form-control" id="reg_email" name="email" placeholder="name@example.com" required>
                                        <label for="reg_email"><i class="fas fa-envelope me-2 text-muted"></i>Email</label>
                                    </div>
                                </div>

                                <!-- Phone Input -->
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating custom-floating">
                                        <input type="text" class="form-control" id="reg_phone" name="phone" placeholder="Số điện thoại" required>
                                        <label for="reg_phone"><i class="fas fa-phone me-2 text-muted"></i>Số điện thoại</label>
                                    </div>
                                </div>

                                <!-- Password Input -->
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating custom-floating">
                                        <input type="password" class="form-control" id="reg_password" name="password" placeholder="Mật khẩu" required>
                                        <label for="reg_password"><i class="fas fa-lock me-2 text-muted"></i>Mật khẩu</label>
                                    </div>
                                </div>

                                <!-- Password Confirm Input -->
                                <div class="col-md-6 mb-4">
                                    <div class="form-floating custom-floating">
                                        <input type="password" class="form-control" id="reg_password_confirmation" name="password_confirmation" placeholder="Xác nhận" required>
                                        <label for="reg_password_confirmation"><i class="fas fa-check-circle me-2 text-muted"></i>Xác nhận mk</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold premium-btn mb-4">
                                <span class="spinner-border spinner-border-sm d-none me-2" role="status"></span>
                                <span class="btn-text">ĐĂNG KÝ TÀI KHOẢN</span>
                            </button>

                            <!-- Login Link -->
                            <div class="text-center">
                                <p class="text-muted mb-0">Đã có tài khoản? 
                                    <a href="#" class="fw-bold text-decoration-none ms-1" style="color: #2095AE;" data-bs-toggle="modal" data-bs-target="#loginModal">
                                        Đăng nhập ngay
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Profile Modal --><!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 12px; overflow: hidden; box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);">
            <div class="modal-header border-0 bg-info text-white" style="padding: 1.5rem;">
                <h5 class="modal-title" style="font-weight: bold; font-size: 1.25rem;">Thông tin cá nhân</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F7FAFC;">
                @if(Auth::check())
                    @if (session('status') === 'profile-updated')
                        <div class="alert alert-success mb-3" style="border-radius: 8px; background-color: #EDF2F7; color: #4A5568;">
                            {{ __('Profile updated successfully.') }}
                        </div>
                    @endif

                    <form id="updateProfileForm" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="text-center mb-4">
                            <div class="avatar-upload mb-3 position-relative">
                                <img src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('assets/images/users/default-avatar.jpg') }}" 
                                     alt="{{ Auth::user()->name }}" 
                                     class="rounded-circle" 
                                     style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;"
                                     id="preview-avatar">
                                <label for="avatar" class="position-absolute bottom-0 end-0 bg-white rounded-circle p-2 shadow-sm" style="cursor: pointer;">
                                    <i class="fas fa-camera text-primary"></i>
                                    <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*" onchange="previewImage(this)">
                                </label>
                            </div>
                            <h5 class="mb-1" style="font-size: 1.2rem; font-weight: bold; color: #2D3748;">{{ Auth::user()->name }}</h5>
                            <p class="text-muted" style="font-size: 0.875rem;">Thành viên từ {{ Auth::user()->created_at->format('d/m/Y') }}</p>

                            <button type="button" class="btn btn-outline-primary btn-sm mt-2" onclick="document.getElementById('avatar').click()" style="font-size: 0.875rem; padding: 0.5rem 1.25rem; border-radius: 8px;">
                                <i class="fas fa-camera me-2"></i>Đổi ảnh đại diện
                            </button>
                        </div>

                        <!-- Họ và tên -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="profile_name" name="name" placeholder="Họ và tên" value="{{ old('name', Auth::user()->name) }}" required>
                            <label for="profile_name" style="font-weight: 600;">Họ và tên</label>
                            @error('name')
                                <div class="invalid-feedback" style="font-size: 0.875rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="profile_email" name="email" placeholder="name@example.com" value="{{ old('email', Auth::user()->email) }}" required>
                            <label for="profile_email" style="font-weight: 600;">Email</label>
                            @error('email')
                                <div class="invalid-feedback" style="font-size: 0.875rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Số điện thoại -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="profile_phone" name="phone" placeholder="Số điện thoại" value="{{ old('phone', Auth::user()->phone) }}" required>
                            <label for="profile_phone" style="font-weight: 600;">Số điện thoại</label>
                            @error('phone')
                                <div class="invalid-feedback" style="font-size: 0.875rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-info w-100 mb-3" id="updateProfileBtn" style="padding: 0.8rem; border-radius: 8px; font-size: 1rem;">
                            <i class="fas fa-save me-2"></i>Cập nhật thông tin
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100" style="padding: 0.8rem; border-radius: 8px; font-size: 1rem;">
                            <i class="fas fa-sign-out-alt me-2"></i>Đăng Xuất
                        </button>
                    </form>
                @else
                    <div class="text-center py-4">
                        <p class="mb-3" style="font-size: 1rem;">Vui lòng đăng nhập để xem thông tin cá nhân</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal" style="font-size: 1rem; padding: 0.8rem 1.5rem; border-radius: 8px;">
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
                        <p class="text-muted">Nhập email của bạn để nhn link đặt lại mật khẩu</p>
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
        /* Premium Auth Modals */
        .premium-modal .modal-content {
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .premium-modal .auth-sidebar {
            min-height: 500px;
        }

        /* Custom Floating Inputs */
        .custom-floating > .form-control {
            border: 2px solid #edf2f7;
            border-radius: 12px;
            padding: 1rem 1.25rem;
            height: calc(3.5rem + 2px);
            line-height: 1.25;
            background-color: #f8fafc;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .custom-floating > .form-control:focus {
            background-color: #fff;
            border-color: #2095AE;
            box-shadow: 0 0 0 4px rgba(32, 149, 174, 0.1);
        }

        .custom-floating > label {
            padding: 1rem 1.25rem;
            color: #64748b;
            font-weight: 500;
        }

        .custom-floating > .form-control:focus ~ label,
        .custom-floating > .form-control:not(:placeholder-shown) ~ label {
            transform: scale(0.85) translateY(-0.75rem) translateX(0.15rem);
            color: #2095AE;
            background: transparent;
        }

        /* Custom Checkbox */
        .custom-checkbox .form-check-input {
            width: 1.25em;
            height: 1.25em;
            margin-top: 0.15em;
            border: 2px solid #cbd5e1;
            border-radius: 4px;
            cursor: pointer;
        }

        .custom-checkbox .form-check-input:checked {
            background-color: #2095AE;
            border-color: #2095AE;
        }

        .custom-checkbox .form-check-label {
            padding-left: 0.5em;
            cursor: pointer;
            user-select: none;
        }

        /* Premium Button */
        .premium-btn {
            background: linear-gradient(135deg, #2095AE 0%, #156d81 100%);
            border: none;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px -10px rgba(32, 149, 174, 0.5);
        }

        .premium-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px -10px rgba(32, 149, 174, 0.6);
            background: linear-gradient(135deg, #26B7D4 0%, #1a88a1 100%);
            color: white;
        }

        .premium-btn:active {
            transform: translateY(0);
        }

        /* Close button customization */
        .premium-modal .btn-close {
            background-color: #f1f5f9;
            border-radius: 50%;
            padding: 0.6rem;
            opacity: 0.7;
            transition: all 0.2s;
        }
        
        .premium-modal .btn-close:hover {
            opacity: 1;
            background-color: #e2e8f0;
            transform: rotate(90deg);
        }
        
        .premium-modal .btn-close-white {
            background-color: rgba(255,255,255,0.2);
        }
        
        .premium-modal .btn-close-white:hover {
            background-color: rgba(255,255,255,0.4);
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
                // toastr.error('Có lỗi xảy ra khi cập nhật ảnh đại diện!');
            });
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

function handleFormSubmit(form, actionUrl, successCallback) {
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
        url: actionUrl,
        method: 'POST',
        data: form.serialize(),
        success: function(response) {
            if (response.success) {
                successCallback(response);
            }
        },
        error: function(xhr) {
            // Enable button
            submitBtn.prop('disabled', false);
            btnText.text('Cập nhật'); // Change back to original text
            spinner.addClass('d-none');

            if (xhr.status === 422) {
                // Validation errors
                const errors = xhr.responseJSON.errors;
                for (let field in errors) {
                    $(`#${field}`).addClass('is-invalid').val(errors[field][0]); // Show error on the field
                }
                errorDiv.html('Vui lòng kiểm tra các lỗi bên trên.').show(); // General error message
            } else {
                errorDiv.html('Có lỗi xảy ra, vui lòng thử lại!').show(); // General error message
            }
        }
    }).always(() => {
        // Reset button state
        submitBtn.prop('disabled', false);
        btnText.removeClass('d-none');
        spinner.addClass('d-none');
    });
}

$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        handleFormSubmit($(this), $(this).attr('action'), function(response) {
            window.location.href = response.redirect;
        });
    });

   

    $('#forgotPasswordForm').on('submit', function(e) {
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

    // Hiển thị modal reset password nếu có token
    @if(request()->route('token'))
        $('#resetPasswordModal').modal('show');
    @endif

    $('#registerForm').on('submit', function(event) {
    event.preventDefault();
    
    $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            alert(response.message);  
            window.location.href = "/";  
        },
        error: function(response) {
            alert("Đã có lỗi xảy ra!");
        }
    });
});

});
</script>
@endpush
