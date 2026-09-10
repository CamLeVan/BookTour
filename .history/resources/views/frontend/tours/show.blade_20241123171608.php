@extends('layouts.frontend')

@section('content')
    <x-frontend.tours.gallery :tour="$tour" />
    <x-frontend.tours.details :tour="$tour" />
    <x-frontend.home.testimonials :testimonials="$tour->reviews" />
    <x-frontend.home.clients />
@endsection

@push('styles')
<style>
    .tour-gallery .owl-carousel .item {
        height: 60vh;
    }
    
    .tour-details .price-tag {
        font-size: 2rem;
        color: #aa8453;
    }
    
    .tour-details .rating {
        margin-bottom: 20px;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function(){
    // Gallery Carousel
    $(".tour-gallery .owl-carousel").owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        nav: true,
        dots: true,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>']
    });

    // Testimonials Carousel
    $(".testimonials .owl-carousel").owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        nav: false,
        dots: true
    });

    // Clients Carousel
    $(".clients .owl-carousel").owlCarousel({
        items: 4,
        loop: true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        nav: false,
        dots: false,
        responsive: {
            0: { items: 1 },
            576: { items: 2 },
            768: { items: 3 },
            992: { items: 4 }
        }
    });

    // Accordion
    $('.accordion-box .acc-btn').click(function() {
        $(this).next('.acc-content').slideToggle();
        $(this).parent().toggleClass('active');
        $(this).parent().siblings().find('.acc-content').slideUp();
        $(this).parent().siblings().removeClass('active');
    });
});
</script>
@endpush 