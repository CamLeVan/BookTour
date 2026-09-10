@extends('layouts.frontend')

@section('content')
    <x-frontend.tours.header />
    <x-frontend.tours.list :tours="$tours" :destinations="$destinations" />
    <x-frontend.home.testimonials />
    <x-frontend.home.clients />
@endsection