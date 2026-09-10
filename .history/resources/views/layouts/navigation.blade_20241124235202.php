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
        <a href="javascript:void(0)" onclick="openLoginModal()">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endauth
</nav>

<!-- Login Modal -->
<div class="modal" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Login') }}</h5>
                <button type="button" class="close" onclick="closeLoginModal()">&times;</button>
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

@push('scripts')
<script>
function openLoginModal() {
    var modal = document.getElementById('loginModal');
    modal.style.display = 'block';
    modal.classList.add('show');
}

function closeLoginModal() {
    var modal = document.getElementById('loginModal');
    modal.style.display = 'none';
    modal.classList.remove('show');
}

// Đóng modal khi click bên ngoài
window.onclick = function(event) {
    var modal = document.getElementById('loginModal');
    if (event.target == modal) {
        closeLoginModal();
    }
}
</script>

<style>
.modal {
    display: none;
    background-color: rgba(0,0,0,0.4);
}
.modal.show {
    display: block;
}
.modal-dialog {
    margin: 10% auto;
}
</style>
@endpush
