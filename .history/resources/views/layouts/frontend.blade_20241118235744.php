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
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
</head>
<body>
    @include('components.frontend.preloader')
    @include('components.frontend.scroll-to-top')
    @include('components.frontend.navigation')
    
    @yield('content')
    
    @include('components.frontend.footer')
    
    <!-- Scripts - Đúng thứ tự -->
    <!-- 1. jQuery Core -->
    <script src="{{ asset('frontend/js/jquery-3.6.3.min.js') }}"></script>
    
    <!-- 2. jQuery Migrate -->
    <script src="{{ asset('frontend/js/jquery-migrate-3.0.0.min.js') }}"></script>
    
    <!-- 3. jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    
    <!-- 4. Bootstrap -->
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    
    <!-- 5. Plugins -->
    <script src="{{ asset('frontend/js/modernizr-2.6.2.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.isotope.v3.0.2.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/scrollIt.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/YouTubePopUp.js') }}"></script>
    
    <!-- 6. Custom JS - Luôn để cuối cùng -->
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
</body>
</html>
