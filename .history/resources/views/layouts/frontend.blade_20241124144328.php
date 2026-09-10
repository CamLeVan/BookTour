<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Default blog description')">
    <meta name="keywords" content="@yield('meta_keywords', 'blog, articles, news')">
    <meta property="og:title" content="@yield('og_title', 'Blog Title')">
    <meta property="og:description" content="@yield('og_description', 'Default blog description')">
    <meta property="og:image" content="@yield('og_image', asset('frontend/img/default-og.jpg'))">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>HC Travel</title>
    
    <!-- CSS -->
    <link rel="shortcut icon" href="{{ asset('frontend/img/favicon.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:wght@300;400;500&family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/blog.css') }}">
    @stack('styles')
</head>
<body>
    <div class="loading-overlay">
        <div class="loading-spinner"></div>
    </div>
    
    @include('components.frontend.preloader')
    @include('components.frontend.scroll-to-top')
    @include('components.frontend.navigation')
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    @yield('content')
    
    @include('components.frontend.footer')

    <!-- jQuery -->
    <script src="{{ asset('frontend/js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>  <!-- Quan trọng! -->
    <script src="{{ asset('frontend/js/jquery-migrate-3.0.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/modernizr-2.6.2.min.js') }}"></script>
    <script src="{{ asset('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.isotope.v3.0.2.js') }}"></script>
    <script src="{{ asset('frontend/js/pace.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/scrollIt.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('frontend/js/YouTubePopUp.js') }}"></script>
    <script src="{{ asset('frontend/js/select2.js') }}"></script>
    <script src="{{ asset('frontend/js/datepicker.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/smooth-scroll.min.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <script src="{{ asset('frontend/js/blog.js') }}"></script>
</body>
</html>
