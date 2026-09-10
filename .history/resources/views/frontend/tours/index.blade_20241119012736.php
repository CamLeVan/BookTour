@extends('layouts.frontend')

@section('content')
    <x-frontend.tours.header />
    
    <x-frontend.tours.list 
        :tours="$tours" 
        :destinations="$destinations" 
    />

    <x-frontend.tours.call-to-action :testimonials="$testimonials" />
    <x-frontend.home.clients />
@endsection
