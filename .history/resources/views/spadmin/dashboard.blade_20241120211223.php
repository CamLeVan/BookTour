@extends('layouts.spadmin')

@section('content')
<div class="container">
    <h1>Super Admin Dashboard</h1>
    @if(Auth::check())
        <p>Welcome, {{ Auth::user()->name }}</p>
        <p>Role: {{ Auth::user()->role }}</p>
    @endif

    <div class="menu">
        <h2>Menu</h2>
        <ul>
            <li><a href="{{ route('spadmin.dashboard') }}">Dashboard</a></li>
            <!-- Thêm các menu items khác -->
        </ul>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>
@endsection
