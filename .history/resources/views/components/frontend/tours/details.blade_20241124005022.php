@props(['tour'])

<section class="tour-page section-padding" data-scroll-index="1">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mb-30">
                <div class="section-subtitle">{{ $tour->destination->name }}</div>
                <div class="section-title mb-0">{{ $tour->name }}</div>
                
                <div class="rating mb-30">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="star {{ $i <= $tour->rating ? 'active' : '' }}"></i>
                    @endfor
                    <div class="reviews-count color-2">({{ $tour->reviews_count }} Reviews)</div>
                </div>

                <div class="tour-page head-icon">
                    <p><i class="ti-time"></i> {{ $tour->duration }} Days</p>
                    <p><i class="ti-user"></i> Group: {{ $tour->max_people }} People</p>
                    <p><i class="ti-location-pin"></i> {{ $tour->destination->name }}</p>
                    <p><i class="ti-face-smile"></i> {{ number_format($tour->rating, 1) }} Rating</p>
                </div>

                <h6>Information</h6>
                <p class="mb-30">{{ $tour->description }}</p>

                {{-- Tour Schedule --}}
                <h6>Tour Plan</h6>
                <ul class="accordion-box clearfix">
                    @foreach($tour->schedules as $schedule)
                    <li class="accordion block">
                        <div class="acc-btn">Day {{ $schedule->day }}: {{ $schedule->title }}</div>
                        <div class="acc-content">
                            <div class="content">
                                <div class="text">{{ $schedule->description }}</div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-4">
                <div class="sidebar">
                    <div class="booking-card">
                        <div class="price-header">
                            <span class="label">Giá từ</span>
                            @if($tour->price < $tour->price * 1.2)
                                <span class="original-price">{{ number_format($tour->price * 1.2) }}đ</span>
                            @endif
                            <span class="current-price">{{ number_format($tour->price) }}đ</span>
                            <span class="per-person">/người</span>
                        </div>

                        <div class="tour-highlights">
                            <div class="highlight-item">
                                <i class="ti-calendar"></i>
                                <span>{{ $tour->duration }} ngày</span>
                            </div>
                            <div class="highlight-item">
                                <i class="ti-user"></i>
                                <span>Còn {{ $tour->available_slots }} chỗ</span>
                            </div>
                        </div>

                        @auth
                            <a href="{{ route('frontend.bookings.create', $tour) }}" 
                               class="butn-dark w-100">
                                <span>Đặt Tour Ngay</span>
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="butn-dark w-100">
                                <span>Đăng nhập để đặt tour</span>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.booking-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 0 30px rgba(0,0,0,0.1);
    padding: 25px;
}

.price-header {
    text-align: center;
    margin-bottom: 20px;
}

.price-header .label {
    display: block;
    color: #666;
    margin-bottom: 5px;
}

.original-price {
    color: #999;
    text-decoration: line-through;
    font-size: 0.9em;
    margin-right: 10px;
}

.current-price {
    color: #aa8453;
    font-size: 1.8em;
    font-weight: 600;
}

.per-person {
    color: #666;
    font-size: 0.9em;
}

.tour-highlights {
    margin: 20px 0;
    padding: 15px 0;
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
}

.highlight-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.highlight-item i {
    color: #aa8453;
    margin-right: 10px;
}

.butn-dark {
    margin-top: 15px;
}
</style>