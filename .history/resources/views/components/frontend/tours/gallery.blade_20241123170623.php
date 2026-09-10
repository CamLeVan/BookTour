@props(['tour'])

<header class="header slider tour-gallery">
    <div class="owl-carousel owl-theme">
        <div class="text-center item bg-img" 
             data-overlay-dark="2" 
             data-background="{{ $tour->image_url }}">
            <div class="v-middle caption">
                <h4>{{ $tour->name }}</h4>
                <h1>{{ $tour->destination }}</h1>
            </div>
        </div>
        @foreach($tour->gallery_urls as $imageUrl)
        <div class="text-center item bg-img" 
             data-overlay-dark="2"
             data-background="{{ $imageUrl }}">
            <div class="v-middle caption">
                <h4>{{ $tour->name }}</h4>
                <h1>{{ $tour->destination }}</h1>
            </div>
        </div>
        @endforeach
    </div>

    <div class="tour-info-overlay">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="info-item">
                        <i class="ti-time"></i>
                        <span>{{ $tour->duration }} ngày</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-item">
                        <i class="ti-location-pin"></i>
                        <span>{{ $tour->destination }}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-item">
                        <i class="ti-user"></i>
                        <span>{{ $tour->group_size }} người</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-item">
                        <i class="ti-tag"></i>
                        <span>{{ number_format($tour->price) }} VNĐ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="arrow bounce text-center">
        <a href="#tour-details" class="smooth-scroll">
            <i class="ti-arrow-down"></i>
        </a>
    </div>
</header> 