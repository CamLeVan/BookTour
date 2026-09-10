<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        @if(Auth::check())
            <p>Welcome, {{ Auth::user()->name }}</p>
            <p>Role: {{ Auth::user()->role }}</p>
        @endif

        <div class="menu">
            <h2>Menu</h2>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <!-- Thêm các menu items khác -->
            </ul>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
