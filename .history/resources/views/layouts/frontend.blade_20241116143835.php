<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HC Travel')</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>
    <!-- Preloader -->
    {{-- @include('components.frontend.preloader')
     --}}
    <!-- Navigation -->
    @include('components.frontend.navigation')
    
    <!-- Main Content -->
    @yield('content')
    
    <!-- Footer -->
    @include('components.frontend.footer')
    
    <!-- Scroll to top -->
    @include('components.frontend.scroll-to-top')
    
    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    @stack('scripts')
</body>
</html>
