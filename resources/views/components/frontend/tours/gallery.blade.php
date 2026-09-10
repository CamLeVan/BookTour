@props(['tour'])

<header class="header slider">
    <div class="owl-carousel owl-theme">
        <div class="text-center item bg-img" data-overlay-dark="2"
            data-background="{{ asset('frontend/img/tours/' . $tour->image) }}">
        </div>
        @if ($tour->gallery)
            @php
                $galleryArray = is_string($tour->gallery)
                    ? json_decode($tour->gallery, true)
                    : (is_array($tour->gallery)
                        ? $tour->gallery
                        : []);
            @endphp

            @foreach ($galleryArray as $image)
                <div class="text-center item bg-img" data-overlay-dark="2"
                    data-background="{{ asset('frontend/img/gallery/' . $image) }}">
                </div>
            @endforeach
        @endif
    </div>
    <div class="arrow bounce text-center">
        <a href="#" data-scroll-nav="1" class=""> <i class="ti-arrow-down"></i> </a>
    </div>
</header>
