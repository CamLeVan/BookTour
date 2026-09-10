<section class="tours1 section-padding bg-lightnav" data-scroll-index="1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-subtitle"><span>Chọn điểm đến</span></div>
                <div class="section-title">Tours <span>Nổi bật</span></div>
            </div>
        </div>
        <div class="row">
            @foreach($tours as $tour)
            <div class="col-md-{{ $loop->first ? '8' : '4' }}">
                <div class="item">
                    <div class="position-re o-hidden">
                        <img src="{{ asset($tour->image) }}" alt="{{ $tour->name }}">
                    </div>
                    <span class="category">
                        <a href="#">{{ number_format($tour->price) }} VNĐ</a>
                    </span>
                    <div class="con">
                        @if($tour->reviews_count > 0)
                        <div class="rating">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="star {{ $i <= $tour->rating ? 'active' : '' }}"></i>
                            @endfor
                            <div class="reviews-count">({{ $tour->reviews_count }} đánh giá)</div>
                        </div>
                        @endif
                        <h5>
                            <a href="{{ route('frontend.tours.show', $tour->id) }}">{{ $tour->name }}</a>
                        </h5>
                        <div class="line"></div>
                        <div class="row facilities">
                            <div class="col col-md-12">
                                <ul>
                                    <li><i class="ti-time"></i> {{ $tour->duration }} ngày</li>
                                    <li><i class="ti-user"></i> {{ $tour->group_size }}+</li>
                                    <li><i class="ti-location-pin"></i> {{ $tour->destination }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section> 