@extends('layouts.frontend')

@section('title', 'Trang chủ - HC Travel')

@section('content')
    <!-- Header -->
    <header class="header slider-fade">
        <div class="owl-carousel owl-theme">
            <!-- The opacity overlay -->
            <div class="text-center item bg-img" data-overlay-dark="2" data-background="{{ asset('frontend/img/slider/1.jpg') }}">
                <div class="v-middle caption">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <h4>Let's Travel</h4>
                                <h1>Discover Amazing Places</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Featured Tours Section -->
    <section class="tours section-padding bg-lightnav">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-subtitle">Find your perfect tour</div>
                    <div class="section-title">Featured <span>Tours</span></div>
                </div>
            </div>
            <!-- Tour items sẽ thêm sau -->
        </div>
    </section>
@endsection