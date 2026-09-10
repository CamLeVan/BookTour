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
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endauth
</nav>
