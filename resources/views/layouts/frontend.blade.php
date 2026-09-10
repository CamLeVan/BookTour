<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HC Travel</title>
    
    <!-- CSS -->
    <link rel="shortcut icon" href="{{ asset('frontend/img/favicon.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:wght@300;400;500&family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    @livewireStyles
    @stack('styles')
    
</head>
<body>
    @include('components.frontend.preloader')
    @include('components.frontend.scroll-to-top')
    @include('components.frontend.navigation')
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif<style>
        .floating-buttons {
            position: fixed;
            left: 40px;
            bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            z-index: 1000;
        }
    
        .contact-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: none;
            color: white;
            cursor: pointer;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            animation: shake 0.3s ease-in-out infinite;
            font-size: 14px; /* Điều chỉnh font để phù hợp trên màn hình nhỏ */
        }
    
        .contact-btn.phone {
            background-color: #ef4444;
        }
    
        .contact-btn.zalo {
            background-color: #60a5fa;
        }
    
        .contact-btn.messenger {
            background-color: #3b82f6;
        }
    
        @keyframes shake {
            0%, 100% {
                transform: rotate(0deg) scale(1.1);
            }
            25% {
                transform: rotate(-12deg) scale(1.1);
            }
            50% {
                transform: rotate(0deg) scale(1.1);
            }
            75% {
                transform: rotate(12deg) scale(1.1);
            }
        }
    
        /* Responsive: Điều chỉnh bố cục cho màn hình nhỏ */
        @media (max-width: 768px) {
            .floating-buttons {
                flex-direction: row;
                bottom: 10px;
                left: 10px;
                gap: 10px;
            }
    
            .contact-btn {
                width: 40px; /* Giảm kích thước */
                height: 40px;
                font-size: 12px; /* Giảm kích thước chữ */
            }
    
            .contact-btn svg {
                width: 20px; /* Điều chỉnh kích thước icon */
                height: 20px;
            }
        }
    
        /* Responsive cho màn hình rất nhỏ */
        @media (max-width: 480px) {
            .floating-buttons {
                gap: 8px; /* Thu hẹp khoảng cách */
            }
    
            .contact-btn {
                width: 35px;
                height: 35px;
                font-size: 10px;
            }
    
            .contact-btn svg {
                width: 18px;
                height: 18px;
            }
        }
    </style>
    
    
    <div class="floating-buttons">
        <a href="tel:+0344574050" class="contact-btn phone">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path
                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                </path>
            </svg>
        </a>
        <a href="https://zalo.me/0344574050" class="contact-btn zalo">
            <strong>Zalo</strong>
        </a>
        <a href="https://www.facebook.com/le.van.cam.392241?locale=vi_VN" class="contact-btn messenger">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path
                    d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                </path>
            </svg>
        </a>
    </div>
    
    {{-- ----------------------------- --}}
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
    <script src="{{ asset('frontend/js/scrollIt.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('frontend/js/YouTubePopUp.js') }}"></script>
    <script src="{{ asset('frontend/js/select2.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/smooth-scroll.min.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // Configure Toastr
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>

    {{-- @if(!Request::is('admin/*'))
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/67521d362480f5b4f5a85760/1iecc47np';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->
    @endif

    @auth
        <script>
        var Tawk_API = Tawk_API || {};
        Tawk_API.visitor = {
            name : '{{ auth()->user()->name }}',
            email : '{{ auth()->user()->email }}'
        };
        </script>
    @endauth --}}

    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
    @livewireScripts
    @stack('scripts')
</body>
</html>
