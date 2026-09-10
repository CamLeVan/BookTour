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
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">Profile</a></li>
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
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 bg-light">
                <h5 class="modal-title fw-bold" id="loginModalLabel">Welcome Back!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-muted mb-4">Sign in to continue your journey with HC Travel</p>
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label small fw-bold text-uppercase">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-envelope text-muted"></i>
                            </span>
                            <input type="email" class="form-control bg-light border-start-0" 
                                   id="email" name="email" required autofocus 
                                   placeholder="Enter your email">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label small fw-bold text-uppercase">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-lock text-muted"></i>
                            </span>
                            <input type="password" class="form-control bg-light border-start-0" 
                                   id="password" name="password" required 
                                   placeholder="Enter your password">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label small" for="remember">Keep me signed in</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-primary text-decoration-none small">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 mb-4 rounded-pill fw-bold">
                        Sign In
                    </button>

                    <p class="text-center mb-0 small">
                        Don't have an account? 
                        <a href="#" class="text-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">
                            Create Account
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 bg-light">
                <h5 class="modal-title fw-bold" id="registerModalLabel">Create Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-muted mb-4">Join HC Travel to start your journey!</p>
                
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="form-label small fw-bold text-uppercase">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-user text-muted"></i>
                            </span>
                            <input type="text" class="form-control bg-light border-start-0" 
                                   id="name" name="name" required autofocus 
                                   placeholder="Enter your full name">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="register_email" class="form-label small fw-bold text-uppercase">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-envelope text-muted"></i>
                            </span>
                            <input type="email" class="form-control bg-light border-start-0" 
                                   id="register_email" name="email" required 
                                   placeholder="Enter your email">
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label for="phone" class="form-label small fw-bold text-uppercase">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-phone text-muted"></i>
                            </span>
                            <input type="tel" class="form-control bg-light border-start-0" 
                                   id="phone" name="phone" required 
                                   placeholder="Enter your phone number">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="register_password" class="form-label small fw-bold text-uppercase">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-lock text-muted"></i>
                            </span>
                            <input type="password" class="form-control bg-light border-start-0" 
                                   id="register_password" name="password" required 
                                   placeholder="Create a password">
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label small fw-bold text-uppercase">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-lock text-muted"></i>
                            </span>
                            <input type="password" class="form-control bg-light border-start-0" 
                                   id="password_confirmation" name="password_confirmation" required 
                                   placeholder="Confirm your password">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 mb-4 rounded-pill fw-bold">
                        Create Account
                    </button>

                    <p class="text-center mb-0 small">
                        Already have an account? 
                        <a href="#" class="text-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">
                            Sign In
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            @auth
                <div class="modal-header border-0 bg-light">
                    <h5 class="modal-title fw-bold" id="profileModalLabel">Profile Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Profile Information Form -->
                    <form method="post" action="{{ route('profile.update') }}" class="mb-4">
                        @csrf
                        @method('patch')
                        
                        <div class="mb-4">
                            <label for="name" class="form-label small fw-bold text-uppercase">Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-user text-muted"></i>
                                </span>
                                <input type="text" class="form-control bg-light border-start-0" 
                                       id="name" name="name" value="{{ auth()->user()->name }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label small fw-bold text-uppercase">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-envelope text-muted"></i>
                                </span>
                                <input type="email" class="form-control bg-light border-start-0" 
                                       id="email" name="email" value="{{ auth()->user()->email }}" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill fw-bold">
                            Update Profile
                        </button>
                    </form>

                    <!-- Password Update Form -->
                    <form method="post" action="{{ route('password.update') }}" class="mb-4">
                        @csrf
                        @method('put')
                        
                        <h6 class="fw-bold mb-3">Update Password</h6>

                        <div class="mb-4">
                            <label for="current_password" class="form-label small fw-bold text-uppercase">Current Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input type="password" class="form-control bg-light border-start-0" 
                                       id="current_password" name="current_password" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label small fw-bold text-uppercase">New Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input type="password" class="form-control bg-light border-start-0" 
                                       id="password" name="password" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label small fw-bold text-uppercase">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input type="password" class="form-control bg-light border-start-0" 
                                       id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill fw-bold">
                            Update Password
                        </button>
                    </form>

                    <!-- Delete Account Form -->
                    <form method="post" action="{{ route('profile.destroy') }}" class="mb-0">
                        @csrf
                        @method('delete')
                        
                        <h6 class="fw-bold text-danger mb-3">Delete Account</h6>
                        
                        <div class="mb-4">
                            <label for="delete_password" class="form-label small fw-bold text-uppercase">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input type="password" class="form-control bg-light border-start-0" 
                                       id="delete_password" name="password" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger w-100 py-2 rounded-pill fw-bold"
                                onclick="return confirm('Are you sure you want to delete your account?')">
                            Delete Account
                        </button>
                    </form>
                </div>
            @else
                <div class="modal-header border-0 bg-light">
                    <h5 class="modal-title fw-bold" id="profileModalLabel">Please Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-center">Please login to access your profile settings.</p>
                    <button type="button" class="btn btn-primary w-100 py-2 rounded-pill fw-bold" 
                            data-bs-dismiss="modal" 
                            data-bs-toggle="modal" 
                            data-bs-target="#loginModal">
                        Go to Login
                    </button>
                </div>
            @endauth
        </div>
    </div>
</div>

<!-- Thêm styles -->
@push('styles')
<style>
    /* Modal styles */
    .modal-content {
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        border-radius: 15px 15px 0 0;
        padding: 1.5rem;
    }

    .modal-title {
        color: #2095AE;  /* Màu chủ đạo của HC Travel */
        font-size: 1.5rem;
    }

    /* Form controls */
    .form-control, .input-group-text {
        border: 1px solid #e5e5e5;
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
    }

    .form-control:focus {
        border-color: #2095AE;
        box-shadow: 0 0 0 0.2rem rgba(32, 149, 174, 0.1);
    }

    .input-group-text {
        color: #6c757d;
    }

    /* Button styles */
    .btn-primary {
        background-color: #2095AE;
        border-color: #2095AE;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #1a7a8f;
        border-color: #1a7a8f;
        transform: translateY(-1px);
    }

    /* Checkbox style */
    .form-check-input:checked {
        background-color: #2095AE;
        border-color: #2095AE;
    }

    /* Links */
    .text-primary {
        color: #2095AE !important;
    }

    .text-primary:hover {
        color: #1a7a8f !important;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .modal-dialog {
            margin: 0.5rem;
        }
        
        .modal-content {
            border-radius: 10px;
        }
        
        .modal-header {
            padding: 1rem;
        }
        
        .modal-body {
            padding: 1rem;
        }
    }
</style>
@endpush

<!-- Thêm Font Awesome cho icons -->
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profileModal = new bootstrap.Modal(document.getElementById('profileModal'));
        
        // Handle form submissions
        const forms = document.querySelectorAll('#profileModal form');
        forms.forEach(form => {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                try {
                    const response = await fetch(this.action, {
                        method: this.method,
                        body: new FormData(this),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        }
                    });
                    
                    const data = await response.json();
                    
                    if (response.ok) {
                        // Success
                        profileModal.hide();
                        alert(data.message || 'Updated successfully!');
                        
                        // Refresh page if needed
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        } else {
                            window.location.reload();
                        }
                    } else {
                        // Handle validation errors
                        Object.keys(data.errors || {}).forEach(key => {
                            const input = form.querySelector(`[name="${key}"]`);
                            if (input) {
                                input.classList.add('is-invalid');
                                const feedback = document.createElement('div');
                                feedback.className = 'invalid-feedback';
                                feedback.textContent = data.errors[key][0];
                                input.parentNode.appendChild(feedback);
                            }
                        });
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Something went wrong. Please try again.');
                }
            });
        });
        
        // Clear validation errors when modal is hidden
        document.getElementById('profileModal').addEventListener('hidden.bs.modal', function() {
            const inputs = this.querySelectorAll('.is-invalid');
            inputs.forEach(input => {
                input.classList.remove('is-invalid');
                const feedback = input.parentNode.querySelector('.invalid-feedback');
                if (feedback) feedback.remove();
            });
        });
    });
    </script>
