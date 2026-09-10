@props(['destinations'])

<section class="destination1 section-padding bg-lightnav">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-subtitle">Điểm Đến Hàng Đầu</div>
                <div class="section-title">Điểm Đến <span>Nổi Bật</span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    @foreach($destinations as $destination)
                    <div class="item">
                        <div class="position-re o-hidden">
                            <img src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->name }}">
                        </div>
                        <div class="con">
                            <h5><a href="{{ route('frontend.destinations.show', $destination) }}">
                                <i class="ti-location-pin"></i> {{ $destination->name }}
                            </a></h5>
                            <div class="line"></div>
                            <div class="row facilities">
                                <div class="col col-md-8">
                                    <p>{{ $destination->tours_count }} Tour Du Lịch</p>
                                </div>
                                <div class="col col-md-4 text-right">
                                    <div class="permalink">
                                        <a href="{{ route('frontend.destinations.show', $destination) }}">
                                            Khám Phá <i class="ti-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section> 