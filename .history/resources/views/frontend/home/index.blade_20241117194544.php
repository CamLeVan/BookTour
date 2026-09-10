@extends('layouts.frontend')

@section('title', 'Home - HC Travel')

@section('content')
    <x-frontend.home.header />
    <x-frontend.home.search />
    <x-frontend.home.about />
    <x-frontend.home.tours />
    <x-frontend.home.testimonials />
    <x-frontend.home.clients />
@endsection