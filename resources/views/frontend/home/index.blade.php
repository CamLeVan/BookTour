@extends('layouts.frontend')

@section('content')
    <!-- Header Video -->
    <x-frontend.home.header />

    <!-- Search Form -->
    <x-frontend.home.search :destinations="$destinations" />

    <!-- About Section -->
    <x-frontend.home.about />

    <!-- Popular Tours -->
    <x-frontend.home.tours :tours="$tours" />

    <!-- Numbers/Stats Section -->
    <x-frontend.home.numbers :stats="[
        'totalBookings' => $totalBookings,
        'totalTours' => $totalTours,
        'totalCustomers' => $totalCustomers,
        'totalDestinations' => $totalDestinations
    ]" />

    <!-- Banner Tour Video -->
    <x-frontend.home.banner-video />

    <!-- Popular Destinations -->
    <x-frontend.home.destinations :destinations="$destinations" />

    <!-- Blog Section -->
    <x-frontend.home.blog :posts="$posts" />

    <!-- Testimonials -->
    <x-frontend.home.testimonials :testimonials="$testimonials" />

    <!-- Clients/Partners -->
    <x-frontend.home.clients />
    {{-- <style>
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
        }
 
 
        /* Hiệu ứng hào quang khi hover */
        .contact-btn:hover {
            animation: shake 0.3s ease-in-out infinite;
            /* Tăng tốc độ rung lắc */
            box-shadow: 0 0 15px 5px rgba(255, 255, 255, 0.4),
                0 0 30px 10px rgba(255, 255, 255, 0.2);
            transform-origin: center center;
        }
 
 
        .contact-btn.phone {
            background-color: #ef4444;
        }
 
 
        .contact-btn.phone:hover {
            box-shadow: 0 0 15px 5px rgba(239, 68, 68, 0.4),
                0 0 30px 10px rgba(239, 68, 68, 0.2);
        }
 
 
        .contact-btn.zalo {
            background-color: #60a5fa;
        }
 
 
        .contact-btn.zalo:hover {
            box-shadow: 0 0 15px 5px rgba(96, 165, 250, 0.4),
                0 0 30px 10px rgba(96, 165, 250, 0.2);
        }
 
 
        .contact-btn.messenger {
            background-color: #3b82f6;
        }
 
 
        .contact-btn.messenger:hover {
            box-shadow: 0 0 15px 5px rgba(59, 130, 246, 0.4),
                0 0 30px 10px rgba(59, 130, 246, 0.2);
        }
 
 
        /* Các lớp sóng */
        .contact-btn::before,
        .contact-btn::after,
        .contact-btn .ripple {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: white;
            animation: ping 3s cubic-bezier(0, 0, 0.2, 1) infinite;
            /* Giảm tốc độ sóng */
        }
 
 
        .contact-btn::before {
            opacity: 0.6;
            animation-delay: 0s;
        }
 
 
        .contact-btn::after {
            opacity: 0.4;
            animation-delay: 0.75s;
        }
 
 
        .contact-btn .ripple-1 {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: white;
            opacity: 0.3;
            animation: ping 3s cubic-bezier(0, 0, 0.2, 1) infinite;
            animation-delay: 1.5s;
        }
 
 
        .contact-btn .ripple-2 {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: white;
            opacity: 0.2;
            animation: ping 3s cubic-bezier(0, 0, 0.2, 1) infinite;
            animation-delay: 2.25s;
        }
 
 
        @keyframes ping {
            0% {
                transform: scale(1);
                opacity: 0.6;
            }
 
 
            75%,
            100% {
                transform: scale(2.5);
                opacity: 0;
            }
        }
 
 
        @keyframes shake {
 
 
            0%,
            100% {
                transform: rotate(0deg) scale(1.1);
                /* Thêm scale để tăng kích thước khi rung */
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
    </style>
    <div class="floating-buttons">
        <a href="tel:+1234567890" class="contact-btn phone">
            <div class="ripple-1"></div>
            <div class="ripple-2"></div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path
                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                </path>
            </svg>
        </a>
        <a href="#" class="contact-btn zalo">
            <div class="ripple-1"></div>
            <div class="ripple-2"></div>
            <strong>Zalo</strong>
        </a>
        <a href="#" class="contact-btn messenger">
            <div class="ripple-1"></div>
            <div class="ripple-2"></div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path
                    d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                </path>
            </svg>
        </a>
    </div> --}}
 
 
 
 
@endsection