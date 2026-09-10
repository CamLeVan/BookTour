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
                       href="{{ route('frontend.home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('frontend.about') ? 'active' : '' }}" 
                       href="{{ route('frontend.about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('frontend.tours.*') ? 'active' : '' }}" 
                       href="{{ route('frontend.tours.index') }}">Tours</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('frontend.blog.*') ? 'active' : '' }}" 
                       href="{{ route('frontend.blog.index') }}">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('frontend.contact') ? 'active' : '' }}" 
                       href="{{ route('frontend.contact') }}">Contact</a>
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
                                <i class="fas fa-user me-2"></i>Profile
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('frontend.bookings.history') }}">
                                <i class="fas fa-history me-2"></i>Lịch sử đặt tour
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Login Modal -->
<div class="modal auth-modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="auth-wrapper">
                    <!-- Left Side - Image -->
                    <div class="auth-banner">
                        <div class="overlay"></div>
                        <div class="auth-banner-content">
                            <h2>Welcome Back!</h2>
                            <p>Discover amazing destinations and create unforgettable memories with us.</p>
                        </div>
                    </div>

                    <!-- Right Side - Form -->
                    <div class="auth-form">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <img src="{{ asset('assets/images/logo-b.png') }}" alt="Travol" height="40">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <h3 class="auth-title">Sign In</h3>
                        <p class="auth-subtitle mb-4">Welcome back! Please sign in to continue.</p>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="far fa-envelope"></i>
                                    </span>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="Email Address"
                                           required>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           name="password" 
                                           placeholder="Password"
                                           required>
                                    <button type="button" class="btn btn-link password-toggle">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                                <a href="{{ route('password.request') }}" class="forgot-link">Forgot Password?</a>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                Sign In
                            </button>

                            <div class="divider">
                                <span>or continue with</span>
                            </div>

                            <div class="social-login">
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="fab fa-google"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="fab fa-twitter"></i>
                                </button>
                            </div>

                            <p class="text-center mt-4">
                                Don't have an account? 
                                <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" class="register-link">
                                    Create one
                                </a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal auth-modal fade" id="registerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="auth-wrapper">
                    <!-- Left Side - Image -->
                    <div class="auth-banner">
                        <div class="overlay"></div>
                        <div class="auth-banner-content">
                            <h2>Start Your Journey</h2>
                            <p>Join our community of travelers and explore the world with us.</p>
                        </div>
                    </div>

                    <!-- Right Side - Form -->
                    <div class="auth-form">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <img src="{{ asset('assets/images/logo-b.png') }}" alt="Travol" height="40">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <h3 class="auth-title">Create Account</h3>
                        <p class="auth-subtitle mb-4">Fill in the details to get started.</p>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="far fa-user"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           placeholder="Full Name"
                                           required>
                                </div>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="far fa-envelope"></i>
                                    </span>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="Email Address"
                                           required>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password" 
                                           placeholder="Password"
                                           required>
                                    <button type="button" class="btn btn-link password-toggle">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control"
                                           name="password_confirmation" 
                                           placeholder="Confirm Password"
                                           required>
                                    <button type="button" class="btn btn-link password-toggle">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                Create Account
                            </button>

                            <div class="divider">
                                <span>or sign up with</span>
                            </div>

                            <div class="social-login">
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="fab fa-google"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="fab fa-twitter"></i>
                                </button>
                            </div>

                            <p class="text-center mt-4">
                                Already have an account? 
                                <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="login-link">
                                    Sign in
                                </a>
                            </p>
                        </form>
                    </div>
                </div>
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

<!-- Thêm styles -->
@push('styles')
<style>
    /* Modal styles */
    .modal-content {
        border: none;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .modal-header {
        padding: 1.5rem;
        background: transparent;
    }

    .modal-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
    }

    .modal-body {
        padding: 1.5rem;
    }

    /* Form styles */
    .form-control {
        height: 48px;
        padding: 0.75rem 1rem;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #2196F3;
        box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1);
    }

    /* Button styles */
    .btn {
        height: 48px;
        font-size: 1rem;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: #2196F3;
        border: none;
    }

    .btn-primary:hover {
        background: #1976D2;
        transform: translateY(-1px);
    }

    .btn-success {
        background: #4CAF50;
        border: none;
    }

    .btn-success:hover {
        background: #43A047;
        transform: translateY(-1px);
    }

    /* Link styles */
    .forgot-password {
        color: #2196F3;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .register-link, .login-link {
        color: #2196F3;
        text-decoration: none;
        font-weight: 500;
    }

    .welcome-text {
        color: #666;
        font-size: 1rem;
    }

    /* Checkbox style */
    .form-check-input {
        width: 18px;
        height: 18px;
        margin-top: 0.2rem;
    }

    .form-check-label {
        color: #666;
        font-size: 0.9rem;
        padding-left: 0.5rem;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .modal-dialog {
            margin: 0.5rem;
        }
        
        .modal-content {
            border-radius: 8px;
        }
    }

    /* Auth Modal Styles */
    .auth-modal .modal-dialog {
        max-width: 900px;
    }

    .auth-modal .modal-content {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .auth-wrapper {
        display: flex;
        min-height: 600px;
    }

    /* Banner Side */
    .auth-banner {
        flex: 1;
        background: url('/assets/images/auth-bg.jpg') center/cover;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
        color: white;
        text-align: center;
    }

    .auth-banner .overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(33,150,243,0.9), rgba(33,150,243,0.6));
    }

    .auth-banner-content {
        position: relative;
        z-index: 1;
    }

    .auth-banner h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .auth-banner p {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    /* Form Side */
    .auth-form {
        flex: 1;
        padding: 40px;
        background: white;
    }

    .auth-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .auth-subtitle {
        color: #666;
        font-size: 1rem;
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .input-group {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .input-group-text {
        background: white;
        border: 1px solid #e0e0e0;
        border-right: none;
        color: #666;
        padding: 12px 15px;
    }

    .form-control {
        border: 1px solid #e0e0e0;
        border-left: none;
        padding: 12px 15px;
        height: auto;
        font-size: 1rem;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #2196F3;
    }

    .input-group:focus-within {
        box-shadow: 0 0 0 2px rgba(33,150,243,0.2);
    }

    .password-toggle {
        border: 1px solid #e0e0e0;
        border-left: none;
        color: #666;
        padding: 0 15px;
    }

    /* Buttons */
    .btn-primary {
        background: #2196F3;
        border: none;
        padding: 12px 24px;
        font-weight: 600;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: #1976D2;
        transform: translateY(-1px);
    }

    /* Social Login */
    .divider {
        text-align: center;
        margin: 1.5rem 0;
        position: relative;
    }

    .divider::before,
    .divider::after {
        content: '';
        position: absolute;
        top: 50%;
        width: calc(50% - 60px);
        height: 1px;
        background: #e0e0e0;
    }

    .divider::before {
        left: 0;
    }

    .divider::after {
        right: 0;
    }

    .divider span {
        background: white;
        padding: 0 15px;
        color: #666;
        font-size: 0.9rem;
    }

    .social-login {
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .social-login .btn {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .social-login .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    /* Links */
    .forgot-link,
    .register-link,
    .login-link {
        color: #2196F3;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .forgot-link:hover,
    .register-link:hover,
    .login-link:hover {
        color: #1976D2;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .auth-banner {
            display: none;
        }
        
        .auth-modal .modal-dialog {
            max-width: 400px;
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
    // Password Toggle Visibility
    document.querySelectorAll('.password-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.closest('.input-group').querySelector('input');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
});
</script>
@endpush
