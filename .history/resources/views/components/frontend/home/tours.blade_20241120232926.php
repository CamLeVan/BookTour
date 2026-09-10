@props(['tours'])

<section class="tours1 section-padding bg-lightnav" data-scroll-index="1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-subtitle"><span>Chọn điểm đến của bạn</span></div>
                <div class="section-title">Tour <span>Nổi Bật</span></div>
            </div>
        </div>
        <div class="row">
            @foreach($tours as $tour)
            <div class="col-md-4">
                <div class="item">
                    <div class="position-re o-hidden"> 
                        @if($tour->image)
                            <img src="{{ asset('storage/frontend/img/tours/' . $tour->image) }}" alt="{{ $tour->name }}">
                        @else
                            <img src="{{ asset('storage/frontend/img/tours/1.jpg') }}" alt="Default Tour Image">
                        @endif
                    </div>
                    <div class="con">
                        <div class="category">
                            <span class="category1"><a href="#">{{ $tour->duration }} Ngày</a></span>
                            <span class="category2"><a href="#">{{ number_format($tour->price, 0, ',', '.') }}đ</a></span>
                        </div>
                        <h5><a href="{{ route('frontend.tours.show', $tour) }}">{{ $tour->name }}</a></h5>
                        <div class="line"></div>
                        <div class="row facilities">
                            <div class="col col-md-12">
                                <ul>
                                    <li><i class="ti-time"></i> {{ $tour->duration }} Ngày</li>
                                    <li><i class="ti-user"></i> {{ $tour->max_people }} Người</li>
                                    <li><i class="ti-location-pin"></i> {{ $tour->destination->name }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <a href="{{ route('frontend.tours.index') }}" class="butn-dark2"><span>Xem Tất Cả Tour</span></a>
                </div>
            </div>
        </div>
    </div>
</section>