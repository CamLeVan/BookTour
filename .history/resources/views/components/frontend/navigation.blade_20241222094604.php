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
                <form id="registerForm" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div id="errorMessages" class="alert alert-danger" style="display: none;"></div>
                    
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/logo-b.png') }}" alt="Logo" height="60">
                        <p class="text-muted mt-2">Tạo tài khoản mới</p>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Họ và tên" required>
                        <label for="name">Họ và tên</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="register_email" name="email" placeholder="name@example.com" required>
                        <label for="register_email">Email</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="register_password" name="password" placeholder="Password" required>
                        <label for="register_password">Mật khẩu</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                        <label for="password_confirmation">Xác nhận mật khẩu</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" required>
                        <label for="phone">Số điện thoại</label>
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
                    <!-- Thêm session status message từ Breeze -->
                    @if (session('status') === 'profile-updated')
                        <div class="alert alert-success mb-3">
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
                        
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                id="profile_phone" name="phone" placeholder="Số điện thoại"
                                value="{{ old('phone', Auth::user()->phone) }}" required>
                            <label for="profile_phone">Số điện thoại</label>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-info w-100 mb-3" id="updateProfileBtn">
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
    /* Modal Background & Container */
    .auth-modal .modal-content {
        background: linear-gradient(135deg, #EEF2FF 0%, #ffffff 100%);
        border-radius: 20px;
        border: 1px solid rgba(99, 102, 241, 0.1);
        box-shadow: 
            0 20px 40px rgba(99, 102, 241, 0.08),
            0 0 0 1px rgba(99, 102, 241, 0.03);
    }

    /* Header Style */
    .auth-modal .modal-header {
        background: rgba(99, 102, 241, 0.03);
        border-bottom: 1px solid rgba(99, 102, 241, 0.06);
        padding: 2rem 2rem 1rem;
    }

    .auth-modal .modal-title {
        background: linear-gradient(45deg, #4F46E5, #6366F1);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
    }

    /* Input Fields */
    .custom-input-group .form-control {
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(99, 102, 241, 0.1);
        box-shadow: 0 2px 4px rgba(99, 102, 241, 0.02);
    }

    .custom-input-group .form-control:focus {
        background: #ffffff;
        border-color: #6366F1;
        box-shadow: 
            0 0 0 4px rgba(99, 102, 241, 0.1),
            0 8px 16px rgba(99, 102, 241, 0.05);
    }

    /* Login Button with Modern Gradient */
    .login-btn {
        background: linear-gradient(45deg, #4F46E5, #6366F1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 
            0 4px 12px rgba(99, 102, 241, 0.15),
            inset 0 1px 1px rgba(255, 255, 255, 0.2);
    }

    .login-btn:hover {
        background: linear-gradient(45deg, #4338CA, #4F46E5);
        box-shadow: 
            0 8px 20px rgba(99, 102, 241, 0.25),
            inset 0 1px 1px rgba(255, 255, 255, 0.3);
    }

    /* Links with Soft Gradient */
    .forgot-link, .register-link {
        background: linear-gradient(45deg, #4F46E5, #6366F1);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 600;
    }

    .forgot-link:hover, .register-link:hover {
        background: linear-gradient(45deg, #4338CA, #4F46E5);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Modal Backdrop */
    .modal-backdrop.show {
        opacity: 0.7;
        backdrop-filter: blur(5px);
        background: linear-gradient(135deg, #4338CA 0%, #6366F1 100%);
    }

    /* Glass Effect Support */
    @supports (-webkit-backdrop-filter: none) or (backdrop-filter: none) {
        .auth-modal .modal-content {
            -webkit-backdrop-filter: blur(20px);
            backdrop-filter: blur(20px);
            background: rgba(238, 242, 255, 0.9);
        }
    }

    /* Dark Mode Support */
    @media (prefers-color-scheme: dark) {
        .auth-modal .modal-content {
            background: linear-gradient(135deg, rgba(30, 27, 75, 0.95) 0%, rgba(40, 37, 93, 0.95) 100%);
        }

        .custom-input-group .form-control {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .modal-title, .form-check-label {
            color: #fff;
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
                    // Cập nh���t avatar trong navigation
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
    $('#updateProfileForm').on('submit', function(e) {
        e.preventDefault(); // Ngăn chặn hành vi mặc định của form

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
                // Cập nhật tên trong navbar
                $('.nav-link.dropdown-toggle span').text(data.user.name);
                
                // Hiển thị thông báo thành công
                toastr.success(data.message); // Sử dụng thông báo từ server
                
                // Đóng modal
                const modalElement = document.getElementById('profileModal');
                const modal = bootstrap.Modal.getInstance(modalElement);
                modal.hide();
            } else {
                toastr.error(data.message); // Hiển thị thông báo lỗi
            }
        })
        .catch(error => {
            console.error('Error:', error);
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
                    let errorMessages = '';
                    
                    for (let field in errors) {
                        errorMessages += errors[field][0] + '<br>';
                        $(`#${field}`).addClass('is-invalid');
                    }
                    
                    errorDiv.html('Thông tin đăng nhập không chính xác. Vui lòng kiểm tra lại.').show();
                    // toastr.error(errorMessages || 'Thông tin đăng nhập không chính xác.');
                } else {
                    $('#errorMessages').text('Có lỗi xảy ra, vui lòng thử lại!').show();
                }
            }
        });
    });
});
</script>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $('#updateProfileForm').on('submit', function(e) {
        e.preventDefault(); // Ngăn chặn hành vi mặc định của form

        // Reset thông báo lỗi và thành công
        $('#profileErrorMessages').hide().html('');
        $('#profileSuccessMessage').hide().html('');

        // Gửi yêu cầu AJAX
        $.ajax({
            url: $(this).attr('action'), // Đường dẫn đến route cập nhật profile
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Hiển thị thông báo thành công
                $('#profileSuccessMessage').html('Cập nhật thông tin thành công!').show();
                // Cập nhật tên trong navbar nếu cần
                $('.nav-link.dropdown-toggle span').text(response.user.name);
            },
            error: function(xhr) {
                // Hiển thị thông báo lỗi
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessages = '';
                    $.each(errors, function(key, value) {
                        errorMessages += value.join('<br>') + '<br>'; // Kết hợp các lỗi cho mỗi trường
                    });
                    $('#profileErrorMessages').html(errorMessages).show(); // Hiển thị tất cả lỗi
                } else {
                    $('#profileErrorMessages').text('Có lỗi xảy ra, vui lòng thử lại!').show();
                }
            }
        });
    });
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
                    let errorMessages = '';
                    
                    for (let field in errors) {
                        errorMessages += errors[field][0] + '<br>';
                        $(`#${field}`).addClass('is-invalid');
                    }
                    
                    errorDiv.html('Thông tin đăng nhập không chính xác. Vui lòng kiểm tra lại.').show();
                    toastr.error(errorMessages || 'Thông tin đăng nhập không chính xác.');
                } else {
                    $('#errorMessages').text('Có lỗi xảy ra, vui lòng thử lại!').show();
                }
            }
        });
    });
});
</script>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $('#updateProfileForm').on('submit', function(e) {
        e.preventDefault(); // Ngăn chặn hành vi mặc định của form

        // Reset thông báo lỗi và thành công
        $('#profileErrorMessages').hide().html('');
        $('#profileSuccessMessage').hide().html('');

        // Gửi yêu cầu AJAX
        $.ajax({
            url: $(this).attr('action'), // Đường dẫn đến route cập nhật profile
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Hiển thị thông báo thành công
                $('#profileSuccessMessage').html('Cập nhật thông tin thành công!').show();
                // Cập nhật tên trong navbar nếu cần
                $('.nav-link.dropdown-toggle span').text(response.user.name);
            },
            error: function(xhr) {
                // Hiển thị thông báo lỗi
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessages = '';
                    $.each(errors, function(key, value) {
                        errorMessages += value.join('<br>') + '<br>'; // Kết hợp các lỗi cho mỗi trường
                    });
                    $('#profileErrorMessages').html(errorMessages).show(); // Hiển thị tất cả lỗi
                } else {
                    $('#profileErrorMessages').text('Có lỗi xảy ra, vui lòng thử lại!').show();
                }
            }
        });
    });
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
                    let errorMessages = '';
                    
                    for (let field in errors) {
                        errorMessages += errors[field][0] + '<br>';
                        $(`#${field}`).addClass('is-invalid');
                    }
                    
                    errorDiv.html('Thông tin đăng nhập không chính xác. Vui lòng kiểm tra lại.').show();
                    toastr.error(errorMessages || 'Thông tin đăng nhập không chính xác.');
                } else {
                    $('#errorMessages').text('Có lỗi xảy ra, vui lòng thử lại!').show();
                }
            }
        });
    });
});
</script>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $('#updateProfileForm').on('submit', function(e) {
        e.preventDefault(); // Ngăn chặn hành vi mặc định của form

        // Reset thông báo lỗi và thành công
        $('#profileErrorMessages').hide().html('');
        $('#profileSuccessMessage').hide().html('');

        // Gửi yêu cầu AJAX
        $.ajax({
            url: $(this).attr('action'), // Đường dẫn đến route cập nhật profile
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Hiển thị thông báo thành công
                $('#profileSuccessMessage').html('Cập nhật thông tin thành công!').show();
                // Cập nhật tên trong navbar nếu cần
                $('.nav-link.dropdown-toggle span').text(response.user.name);
            },
            error: function(xhr) {
                // Hiển thị thông báo lỗi
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessages = '';
                    $.each(errors, function(key, value) {
                        errorMessages += value.join('<br>') + '<br>'; // Kết hợp các lỗi cho mỗi trường
                    });
                    $('#profileErrorMessages').html(errorMessages).show(); // Hiển thị tất cả lỗi
                } else {
                    $('#profileErrorMessages').text('Có lỗi xảy ra, vui lòng thử lại!').show();
                }
            }
        });
    });
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
                    let errorMessages = '';
                    
                    for (let field in errors) {
                        errorMessages += errors[field][0] + '<br>';
                        $(`#${field}`).addClass('is-invalid');
                    }
                    
                    errorDiv.html('Thông tin đăng nhập không chính xác. Vui lòng kiểm tra lại.').show();
                    toastr.error(errorMessages || 'Thông tin đăng nhập không chính xác.');
                } else {
                    $('#errorMessages').text('Có lỗi xảy ra, vui lòng thử lại!').show();
                }
            }
        });
    });
});
</script>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $('#updateProfileForm').on('submit', function(e) {
        e.preventDefault(); // Ngăn chặn hành vi mặc định của form

        // Reset thông báo lỗi và thành công
        $('#profileErrorMessages').hide().html('');
        $('#profileSuccessMessage').hide().html('');

        // Gửi yêu cầu AJAX
        $.ajax({
            url: $(this).attr('action'), // Đường dẫn đến route cập nhật profile
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Hiển thị thông báo thành công
                $('#profileSuccessMessage').html('Cập nhật thông tin thành công!').show();
                // Cập nhật tên trong navbar nếu cần
                $('.nav-link.dropdown-toggle span').text(response.user.name);
            },
            error: function(xhr) {
                // Hiển thị thông báo lỗi
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessages = '';
                    $.each(errors, function(key, value) {
                        errorMessages += value.join('<br>') + '<br>'; // Kết hợp các lỗi cho mỗi trường
                    });
                    $('#profileErrorMessages').html(errorMessages).show(); // Hiển thị tất cả lỗi
                } else {
                    $('#profileErrorMessages').text('Có lỗi xảy ra, vui lòng thử lại!').show();
                }
            }
        });
    });
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
                    let errorMessages = '';
                    
                    for (let field in errors) {
                        errorMessages += errors[field][0] + '<br>';
                        $(`#${field}`).addClass('is-invalid');
                    }
                    
                    errorDiv.html('Thông tin đăng nhập không chính xác. Vui lòng kiểm tra lại.').show();
                    toastr.error(errorMessages || 'Thông tin đăng nhập không chính xác.');
                } else {
                    $('#errorMessages').text('Có lỗi xảy ra, vui lòng thử lại!').show();
                }
            }
        });
    });
});
</script>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $('#updateProfileForm').on('submit', function(e) {
        e.preventDefault(); // Ngăn chặn hành vi mặc định của form

        // Reset thông báo lỗi và thành công
        $('#profileErrorMessages').hide().html('');
        $('#profileSuccessMessage').hide().html('');

        // Gửi yêu cầu AJAX
        $.ajax({
            url: $(this).attr('action'), // Đường dẫn đến route cập nhật profile
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Hiển thị thông báo thành công
                $('#profileSuccessMessage').html('Cập nhật thông tin thành công!').show();
                // Cập nhật tên trong navbar nếu cần
                $('.nav-link.dropdown-toggle span').text(response.user.name);
            },
            error: function(xhr) {
                // Hiển thị thông báo lỗi
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessages = '';
                    $.each(errors, function(key, value) {
                        errorMessages += value.join('<br>') + '<br>'; // Kết hợp các lỗi cho mỗi trường
                    });
                    $('#profileErrorMessages').html(errorMessages).show(); // Hiển thị tất cả lỗi
                } else {
                    $('#profileErrorMessages').text('Có lỗi xảy ra, vui lòng thử lại!').show();
                }
            }
        });
    });
});
</script>
@endpush
