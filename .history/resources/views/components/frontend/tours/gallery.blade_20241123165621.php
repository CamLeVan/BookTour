@props(['tour'])

<header class="header slider">
    <div class="owl-carousel owl-theme">
        <div class="text-center item bg-img" 
             data-overlay-dark="2" 
             data-background="{{ asset('frontend/' . $tour->image) }}">
        </div>
        @foreach($tour->gallery ?? [] as $image)
        <div class="text-center item bg-img" 
             data-overlay-dark="2"
             data-background="{{ asset('frontend/' . $image) }}">
        </div>
        @endforeach
    </div>
    <div class="arrow bounce text-center">
        <a href="#" data-scroll-nav="1" class=""> <i class="ti-arrow-down"></i> </a>
    </div>
</header> 