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
            @if($tours->isNotEmpty())
            <div class="col-md-8">
                <div class="item">
                    <div class="position-re o-hidden"> 
                        @if($tours[0]->image)
                            <img src="{{ asset('frontend/' . $tours[0]->image) }}" alt="{{ $tours[0]->name }}">
                        @else
                            <img src="{{ asset('frontend/img/tours/1.jpg') }}" alt="Default Tour Image">
                        @endif
                    </div>
                    <span class="category"><a href="#">{{ number_format($tours[0]->price, 0, ',', '.') }}đ</a></span>
                    <div class="con">
                        <div class="rating"> 
                            <i class="star active"></i>
                            <i class="star active"></i>
                            <i class="star active"></i>
                            <i class="star active"></i>
                            <i class="star"></i>
                            <div class="reviews-count">({{ $tours[0]->reviews_count ?? 0 }} Đánh giá)</div>
                        </div>
                        <h5><a href="{{ route('frontend.tours.show', $tours[0]) }}">{{ $tours[0]->name }}</a></h5>
                        <div class="line"></div>
                        <div class="row facilities">
                            <div class="col col-md-12">
                                <ul>
                                    <li><i class="ti-time"></i> {{ $tours[0]->duration }} Ngày</li>
                                    <li><i class="ti-user"></i> {{ $tours[0]->max_people }} Người</li>
                                    <li><i class="ti-location-pin"></i> {{ $tours[0]->destination->name }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @foreach($tours->skip(1) as $tour)
            <div class="col-md-4">
                <div class="item">
                    <div class="position-re o-hidden"> 
                        @if($tour->image)
                            <img src="{{ asset('frontend/' . $tour->image) }}" alt="{{ $tour->name }}">
                        @else
                            <img src="{{ asset('frontend/img/tours/1.jpg') }}" alt="Default Tour Image">
                        @endif
                    </div>
                    <span class="category"><a href="#">{{ number_format($tour->price, 0, ',', '.') }}đ</a></span>
                    <div class="con">
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