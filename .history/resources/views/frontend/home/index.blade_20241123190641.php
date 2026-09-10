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
@endsection