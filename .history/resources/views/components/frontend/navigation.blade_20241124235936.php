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
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('frontend.bookings.history') }}">Lịch sử đặt tour</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Background Image Section -->
                        <div class="col-md-5 d-none d-md-block login-bg-image">
                            <div class="login-bg-overlay">
                                <div class="login-bg-content">
                                    <h3>Welcome to HC Travel</h3>
                                    <p>Discover your next adventure with us</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Form Section -->
                        <div class="col-md-7 login-form-section">
                            <div class="p-4 p-md-5">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="login-title mb-0">Sign In</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-4">
                                        <div class="floating-label">
                                            <input type="email" class="form-control custom-input" 
                                                   id="email" name="email" required autofocus placeholder=" ">
                                            <label for="email">Email Address</label>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="floating-label">
                                            <input type="password" class="form-control custom-input" 
                                                   id="password" name="password" required placeholder=" ">
                                            <label for="password">Password</label>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                            <label class="custom-control-label" for="remember">Remember me</label>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="forgot-link">
                                                Forgot password?
                                            </a>
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-login w-100">
                                        Sign In
                                    </button>

                                    <div class="divider my-4">
                                        <span>or continue with</span>
                                    </div>

                                    <div class="social-login mb-4">
                                        <button type="button" class="btn btn-social btn-google">
                                            <i class="fab fa-google"></i>
                                        </button>
                                        <button type="button" class="btn btn-social btn-facebook">
                                            <i class="fab fa-facebook-f"></i>
                                        </button>
                                        <button type="button" class="btn btn-social btn-twitter">
                                            <i class="fab fa-twitter"></i>
                                        </button>
                                    </div>

                                    <p class="text-center mb-0">
                                        Don't have an account? 
                                        <a href="{{ route('register') }}" class="register-link">
                                            Create Account
                                        </a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Modal Styles */
    .modal-content {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }

    /* Background Image Section */
    .login-bg-image {
        background: url('https://images.unsplash.com/photo-1682687220742-aba13b6e50ba?q=80') center/cover;
        min-height: 550px;
        position: relative;
    }

    .login-bg-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(145deg, rgba(32,149,174,0.9), rgba(0,0,0,0.6));
        display: flex;
        align-items: center;
        padding: 2rem;
    }

    .login-bg-content {
        color: white;
    }

    .login-bg-content h3 {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .login-bg-content p {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    /* Form Section */
    .login-form-section {
        background: #f8f9fa;
    }

    .login-title {
        color: #2c3e50;
        font-weight: 600;
        font-size: 1.5rem;
    }

    /* Floating Label Inputs */
    .floating-label {
        position: relative;
    }

    .custom-input {
        height: 55px;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: all 0.3s;
        background: white;
    }

    .custom-input:focus {
        border-color: #2095AE;
        box-shadow: 0 0 0 4px rgba(32,149,174,0.1);
    }

    .floating-label label {
        position: absolute;
        top: 50%;
        left: 1rem;
        transform: translateY(-50%);
        transition: all 0.3s;
        pointer-events: none;
        color: #6c757d;
    }

    .custom-input:focus + label,
    .custom-input:not(:placeholder-shown) + label {
        top: 0;
        transform: translateY(-50%) scale(0.85);
        background: white;
        padding: 0 0.5rem;
    }

    /* Custom Checkbox */
    .custom-control-label {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .custom-control-input:checked ~ .custom-control-label::before {
        background-color: #2095AE;
        border-color: #2095AE;
    }

    /* Login Button */
    .btn-login {
        height: 55px;
        background: linear-gradient(145deg, #2095AE, #1a7a8f);
        border: none;
        border-radius: 12px;
        color: white;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(32,149,174,0.3);
    }

    /* Divider */
    .divider {
        position: relative;
        text-align: center;
    }

    .divider::before,
    .divider::after {
        content: '';
        position: absolute;
        top: 50%;
        width: 45%;
        height: 1px;
        background: #e0e0e0;
    }

    .divider::before { left: 0; }
    .divider::after { right: 0; }

    .divider span {
        background: #f8f9fa;
        padding: 0 1rem;
        color: #6c757d;
        font-size: 0.9rem;
    }

    /* Social Login */
    .social-login {
        display: flex;
        justify-content: center;
        gap: 1rem;
    }

    .btn-social {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #e0e0e0;
        background: white;
        transition: all 0.3s;
    }

    .btn-social:hover {
        transform: translateY(-2px);
    }

    .btn-google:hover { color: #DB4437; }
    .btn-facebook:hover { color: #4267B2; }
    .btn-twitter:hover { color: #1DA1F2; }

    /* Links */
    .forgot-link,
    .register-link {
        color: #2095AE;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s;
    }

    .forgot-link:hover,
    .register-link:hover {
        color: #1a7a8f;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .modal-dialog {
            margin: 0.5rem;
        }
        
        .login-form-section {
            padding: 1.5rem;
        }
    }
</style>
@endpush

<!-- Thêm Font Awesome cho icons -->
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush
