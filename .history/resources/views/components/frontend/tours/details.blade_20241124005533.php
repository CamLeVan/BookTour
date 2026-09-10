@props(['tour'])

<section class="tour-page section-padding" data-scroll-index="1">
    <div class="container">
        <div class="row">
            {{-- Cột thông tin tour bên trái --}}
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

            {{-- Cột đặt tour bên phải --}}
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
/* Card Booking */
.booking-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 30px rgba(0,0,0,0.1);
    padding: 30px;
    transition: all 0.3s ease;
}

.booking-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 35px rgba(0,0,0,0.15);
}

/* Price Header */
.price-header {
    text-align: center;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.price-header .label {
    display: block;
    color: #666;
    font-size: 0.9em;
    margin-bottom: 8px;
}

.original-price {
    color: #999;
    text-decoration: line-through;
    font-size: 1.1em;
    margin-right: 10px;
}

.current-price {
    color: #aa8453;
    font-size: 2.2em;
    font-weight: 700;
    letter-spacing: -1px;
}

.per-person {
    color: #666;
    font-size: 0.9em;
}

/* Tour Highlights */
.tour-highlights {
    margin: 20px 0;
    padding: 20px 0;
    border-bottom: 1px solid #eee;
}

.highlight-item {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    padding: 10px 15px;
    background: #f8f9fa;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.highlight-item:hover {
    background: #f0f2f5;
    transform: translateX(5px);
}

.highlight-item i {
    color: #aa8453;
    margin-right: 12px;
    font-size: 1.2em;
}

.highlight-item span {
    color: #444;
    font-weight: 500;
}

/* Button Styles */
.butn-dark {
    display: inline-block;
    text-align: center;
    padding: 15px 25px;
    border-radius: 8px;
    background: #aa8453;
    color: white;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    border: 2px solid #aa8453;
    width: 100%;
    margin-top: 20px;
    position: relative;
    overflow: hidden;
}

.butn-dark:hover {
    background: transparent;
    color: #aa8453;
    transform: translateY(-2px);
}

.butn-dark span {
    position: relative;
    z-index: 2;
}

.butn-dark:before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.1);
    transition: all 0.5s ease;
}

.butn-dark:hover:before {
    left: 100%;
}

/* Responsive */
@media (max-width: 768px) {
    .booking-card {
        margin-top: 30px;
        padding: 20px;
    }

    .current-price {
        font-size: 1.8em;
    }

    .highlight-item {
        padding: 8px 12px;
    }
}

/* Tour Information */
.tour-page .head-icon {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
    margin: 25px 0;
}

.tour-page .head-icon p {
    display: flex;
    align-items: center;
    color: #666;
    font-size: 0.95em;
}

.tour-page .head-icon i {
    color: #aa8453;
    margin-right: 10px;
    font-size: 1.2em;
}

/* Rating Stars */
.rating {
    display: flex;
    align-items: center;
    gap: 5px;
}

.star {
    color: #ddd;
    font-size: 1.2em;
}

.star.active {
    color: #ffc107;
}

.reviews-count {
    margin-left: 10px;
    color: #666;
    font-size: 0.9em;
}

/* Accordion Styles */
.accordion-box {
    margin-top: 20px;
}

.accordion {
    margin-bottom: 10px;
    border: 1px solid #eee;
    border-radius: 8px;
    overflow: hidden;
}

.acc-btn {
    padding: 15px 20px;
    background: #f8f9fa;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s ease;
}

.acc-btn:hover {
    background: #f0f2f5;
}

.acc-content {
    display: none;
    padding: 20px;
    background: white;
}

.accordion.active .acc-btn {
    background: #aa8453;
    color: white;
}
</style>
