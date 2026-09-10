@extends('layouts.frontend')

@section('content')
    <!-- Header Banner -->
    <x-frontend.about.header />

    <!-- About Info -->
    <x-frontend.about.info />

    <!-- Team Section -->
    <x-frontend.about.team />

    <!-- Numbers/Stats Section -->
    <x-frontend.home.numbers :stats="[
        'totalBookings' => $totalBookings,
        'totalTours' => $totalTours,
        'totalCustomers' => $totalCustomers,
        'totalDestinations' => $totalDestinations
    ]" />

    <!-- Testimonials -->
    <x-frontend.home.testimonials :testimonials="$testimonials" />

    <!-- Clients/Partners -->
    <x-frontend.home.clients />
@endsection
