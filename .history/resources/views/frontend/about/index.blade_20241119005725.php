@extends('layouts.frontend')

@section('content')
    {{-- <!-- Header Banner -->
    <x-frontend.about.header />

    <!-- About Info -->
    <x-frontend.about.info />

    <!-- Why Choose Us -->
    <x-frontend.about.why-us />

    <!-- Team Members -->
    <x-frontend.about.team /> --}}

    <!-- Numbers/Stats Section -->
    <x-frontend.home.numbers :stats="$stats" />

    <!-- Testimonials -->
    <x-frontend.home.testimonials :testimonials="$testimonials" />

    <!-- Clients/Partners -->
    <x-frontend.home.clients />
@endsection
