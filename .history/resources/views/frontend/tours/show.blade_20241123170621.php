@extends('layouts.frontend')

@section('content')
    {{-- Gallery Section --}}
    <x-frontend.tours.gallery :tour="$tour" />

    {{-- Tour Details Section --}}
    <section id="tour-details" class="tour-details section-padding">
        <x-frontend.tours.details :tour="$tour" />
    </section>

    {{-- Reviews Section --}}
    <section class="testimonials section-padding bg-light">
        <x-frontend.home.testimonials :testimonials="$tour->reviews" />
    </section>

    {{-- Booking Section --}}
    <section class="booking-section section-padding">
        <livewire:frontend.tour-booking :tour="$tour" />
    </section>

    {{-- Related Tours --}}
    <section class="related-tours section-padding bg-light">
        <x-frontend.tours.related :currentTour="$tour" />
    </section>

    {{-- Partners/Clients --}}
    <x-frontend.home.clients />
@endsection

@push('styles')
<style>
    .tour-gallery .owl-carousel .item {
        height: 70vh;
        position: relative;
    }
    
    .tour-gallery .caption {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: #fff;
    }

    .tour-info-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,0.7);
        color: #fff;
        padding: 20px 0;
    }

    .tour-info-overlay .info-item {
        text-align: center;
    }

    .tour-info-overlay .info-item i {
        font-size: 24px;
        margin-bottom: 10px;
        color: #aa8453;
    }

    .tour-details .price-tag {
        font-size: 2rem;
        color: #aa8453;
    }
    
    .tour-details .rating {
        margin-bottom: 20px;
    }

    .section-padding {
        padding: 80px 0;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function(){
    // Owl Carousel initialization
    $(".owl-carousel").owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        nav: true,
        dots: true,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>']
    });

    // Smooth scroll
    $('.smooth-scroll').on('click', function(e) {
        e.preventDefault();
        var target = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(target).offset().top
        }, 1000);
    });
});
</script>
@endpush 