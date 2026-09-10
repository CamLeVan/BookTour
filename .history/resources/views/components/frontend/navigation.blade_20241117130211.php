<nav class="navbar navbar-expand-lg">
    <div class="container">
        <!-- Logo -->
        <div class="logo-wrapper navbar-brand">
            <a class="logo" href="{{ route('frontend.home') }}">
                <!-- Logo Image Option -->
                <img src="{{ asset('frontend/img/logo-light.png') }}" class="logo-img" alt="HC Travel">
                <!-- Text Logo Option -->
                <!-- <h2>HC TRAVEL <span>explore the world</span></h2> -->
            </a>
        </div>
        
        <!-- Navigation Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" 
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="ti-menu"></i></span>
        </button>
        
        <!-- Main Menu -->
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ms-auto">
                <!-- Home -->
                <li class="nav-item dropdown">
                    <a class="nav-link {{ Route::is('frontend.home') ? 'active' : '' }} dropdown-toggle" 
                       href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Home
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('frontend.home') }}">Home Default</a></li>
                        <li><a class="dropdown-item" href="{{ route('frontend.home.video') }}">Home Video</a></li>
                    </ul>
                </li>

                <!-- About -->
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('frontend.about') ? 'active' : '' }}" 
                       href="{{ route('frontend.about') }}">About</a>
                </li>

                <!-- Tours -->
                <li class="nav-item dropdown">
                    <a class="nav-link {{ Route::is('frontend.tours.*') ? 'active' : '' }} dropdown-toggle" 
                       href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tours
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('frontend.tours.index') }}">All Tours</a></li>
                        <li><a class="dropdown-item" href="{{ route('frontend.tours.domestic') }}">Domestic Tours</a></li>
                        <li><a class="dropdown-item" href="{{ route('frontend.tours.international') }}">International Tours</a></li>
                        <li><a class="dropdown-item" href="{{ route('frontend.tours.search') }}">Tour Search</a></li>
                    </ul>
                </li>

                <!-- Blog -->
                <li class="nav-item dropdown">
                    <a class="nav-link {{ Route::is('frontend.blog.*') ? 'active' : '' }} dropdown-toggle" 
                       href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Blog
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('frontend.blog.index') }}">Blog Grid</a></li>
                        <li><a class="dropdown-item" href="{{ route('frontend.blog.list') }}">Blog List</a></li>
                    </ul>
                </li>

                <!-- Contact -->
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('frontend.contact') ? 'active' : '' }}" 
                       href="{{ route('frontend.contact') }}">Contact</a>
                </li>

                <!-- Auth Menu -->
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti-user"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="ti-settings"></i> Profile Settings</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('frontend.bookings') }}">
                                <i class="ti-ticket"></i> My Bookings</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('frontend.wishlist') }}">
                                <i class="ti-heart"></i> Wishlist</a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="ti-power-off"></i> Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="ti-user"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
