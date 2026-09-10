<div class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('spadmin.dashboard') ? 'active' : '' }}" 
               href="{{ route('spadmin.dashboard') }}">
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Tours</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Bookings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Users</a>
        </li>
    </ul>
</div>