@extends('layouts.frontend')

@section('title', 'Home - HC Travel')

@section('content')
    <x-frontend.home.header />
    <x-frontend.home.search />
    <x-frontend.home.about />
    <x-frontend.home.tours :tours="$tours" />
    <x-frontend.home.clients />
@endsection