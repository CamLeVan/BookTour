<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>{{ config('app.name') }}</title>
    
    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Preloader -->
    @include('components.frontend.preloader')
    
    <!-- Progress scroll totop -->
    @include('components.frontend.scroll-to-top')
    
    <!-- Navbar -->
    @include('components.frontend.navigation')
    
    <!-- Main Content -->
    {{ $slot }}
    
    <!-- Footer -->
    @include('components.frontend.footer')
    
    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/scrollIt.min.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    @livewireScripts
</body>
</html>