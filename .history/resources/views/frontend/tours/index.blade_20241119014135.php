@extends('layouts.frontend')

@section('content')
    <!-- Header Banner -->
    <x-frontend.tours.header />

    <!-- Tours List -->
    <x-frontend.tours.list :tours="$tours" />

    <!-- Call & Testimonials -->
    <x-frontend.tours.call-to-action :testimonials="$testimonials" />

    <!-- Clients -->
    <x-frontend.home.clients />
@endsection
