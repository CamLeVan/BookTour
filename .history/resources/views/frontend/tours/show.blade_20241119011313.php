@extends('layouts.frontend')

@section('content')
    <x-frontend.tours.detail.slider :tour="$tour" />

    <section class="tour-page section-padding" data-scroll-index="1">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mb-30">
                    <x-frontend.tours.detail.info :tour="$tour" />
                    <x-frontend.tours.detail.content :tour="$tour" />
                    <x-frontend.tours.detail.gallery :tour="$tour" />
                    <x-frontend.tours.detail.plan :tour="$tour" />
                </div>

                <div class="col-md-4">
                    <div class="sidebar">
                        <x-frontend.tours.detail.booking-form :tour="$tour" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-frontend.tours.call-to-action :testimonials="$testimonials" />
    <x-frontend.home.clients />
@endsection 