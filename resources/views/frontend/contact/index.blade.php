@extends('layouts.frontend')

@section('content')
    <x-frontend.contact.header />
    
    <section class="contact section-padding">
        <div class="container">
            <div class="row mb-90">
                <x-frontend.contact.info />
                <x-frontend.contact.form />
            </div>
            <x-frontend.contact.map />
        </div>
    </section>

    <x-frontend.home.testimonials />
    <x-frontend.home.clients />
@endsection
