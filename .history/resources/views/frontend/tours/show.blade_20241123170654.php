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