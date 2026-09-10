<x-app-layout>
    <!-- Header Video -->
    <header class="header slider-fade">
        <div class="owl-carousel owl-theme">
            <!-- Thêm slider content của bạn vào đây -->
            <div class="text-center item bg-img" data-overlay-dark="2" data-background="{{ asset('img/slider/1.jpg') }}">
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

    <!-- Tour Search Section -->
    @livewire('frontend.tour-search')

    <!-- Featured Tours Section -->
    <section class="tours section-padding bg-lightnav">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-subtitle">Find your perfect tour</div>
                    <div class="section-title">Featured <span>Tours</span></div>
                </div>
            </div>
            <div class="row">
                @foreach($featuredTours as $tour)
                    <div class="col-md-4">
                        <div class="item">
                            <div class="position-re o-hidden">
                                <img src="{{ asset('img/tours/' . $tour->image) }}" alt="">
                            </div>
                            <div class="con">
                                <h5><a href="{{ route('tours.show', $tour) }}">{{ $tour->name }}</a></h5>
                                <div class="line"></div>
                                <div class="row facilities">
                                    <div class="col col-md-12">
                                        <p>{{ Str::limit($tour->description, 100) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
