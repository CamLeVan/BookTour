<nav>
    <!-- Menu chính -->
    @auth
        @if(auth()->user()->role === 'user')
            <a href="/">Home</a>
            <a href="/about">About</a>
            <a href="/tour">Tour</a>
            <a href="/blog">Blog</a>
            <a href="/contact">Contact</a>
        @endif
        
        <div class="dropdown">
            <button class="dropdown-toggle">
                {{ Auth::user()->name }}
            </button>
            <div class="dropdown-menu">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </div>
        </div>
    @else
        <a href="/">Home</a>
        <a href="/about">About</a>
        <a href="/tour">Tour</a>
        <a href="/blog">Blog</a>
        <a href="/contact">Contact</a>
        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endauth
</nav>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">{{ __('Login') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
