@extends('layouts.frontend')

@section('content')
    <x-frontend.tours.header />
    
    <div class="container mx-auto px-4 py-8">
        <livewire:tour-search />
    </div>

    <x-frontend.tours.call-to-action :testimonials="$testimonials" />
    <x-frontend.home.clients />
@endsection