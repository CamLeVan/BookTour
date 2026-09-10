@extends('layouts.frontend')

@section('content')
    <x-frontend.home.header />
    <x-frontend.home.search />
    <x-frontend.home.about />
    <x-frontend.home.tours :tours="$tours" />
    <x-frontend.home.numbers :stats="[
        'totalBookings' => $totalBookings,
        'totalTours' => $totalTours,
        'totalCustomers' => $totalCustomers,
        'totalDestinations' => $totalDestinations
    ]" />
    <x-frontend.home.banner-video />
    <x-frontend.home.destinations :destinations="$destinations" />
    <x-frontend.home.testimonials :testimonials="$testimonials" />
    <x-frontend.home.clients />
@endsection