<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HC Travel')</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
</head>
<body>
    @include('components.frontend.navigation')
    @yield('content')
    @include('components.frontend.footer')
    
    <!-- Scripts -->
    <script src="{{ asset('frontend/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/js/scripts.js') }}"></script>
</body>
</html>
