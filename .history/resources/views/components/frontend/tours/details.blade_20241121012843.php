@props(['tour'])

<section class="tour-page section-padding" data-scroll-index="1">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mb-30">
                <div class="section-subtitle">{{ $tour->destination->name }}</div>
                <div class="section-title mb-0">{{ $tour->name }}</div>
                
                <div class="tour-page head-icon">
                    <p><i class="ti-time"></i> {{ $tour->duration }} Days</p>
                    <p><i class="ti-user"></i> Group: {{ $tour->max_people }} People</p>
                    <p><i class="ti-location-pin"></i> {{ $tour->destination->name }}</p>
                </div>

                <h6>Information</h6>
                <p class="mb-30">{{ $tour->description }}</p>

                <!-- Tour details -->
                <div class="tour-page time-table">
                    <span>Departure</span>
                    <p>{{ $tour->departure_location }}</p>
                </div>

                <!-- Price includes/excludes -->
                <div class="tour-page time-table-price">
                    <span>Price Includes</span>
                    <ul class="tour-page time-table-price-include">
                        @foreach($tour->price_includes as $include)
                        <li><i class="ti-check"></i> {{ $include }}</li>
                        @endforeach
                    </ul>
                </div>

                <!-- Gallery -->
                <h6 class="mb-0">Tour Gallery</h6>
                <div class="row">
                    @foreach($tour->gallery as $image)
                    <div class="col-md-4 gallery-item">
                        <a href="{{ asset('storage/gallery/' . $image) }}" class="img-zoom">
                            <div class="gallery-box">
                                <div class="gallery-img">
                                    <img src="{{ asset('storage/gallery/' . $image) }}" class="img-fluid" alt="gallery">
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

                <!-- Tour plan -->
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

            <!-- Booking form -->
            <div class="col-md-4">
                <div class="right-sidebar">
                    <div class="right-sidebar item">
                        <h3>
                            <span class="right-sidebar item__from">From</span>
                            <span class="right-sidebar item__sale">{{ number_format($tour->price * 1.2) }}đ</span>
                            {{ number_format($tour->price) }}đ
                        </h3>
                        
                        <form method="POST" action="{{ route('frontend.bookings.store') }}" class="right-sidebar item-form">
                            @csrf
                            <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                            
                            @guest
                                <div class="alert alert-warning">
                                    Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để đặt tour
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-12 form-group input1_inner">
                                        <input type="date" 
                                               name="booking_date"
                                               class="form-control input datepicker"
                                               required>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input name="number_of_people"
                                               type="number"
                                               min="1" 
                                               max="{{ $tour->max_people }}"
                                               placeholder="Số người"
                                               required>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <textarea name="notes" 
                                                  rows="4"
                                                  placeholder="Ghi chú"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="butn-dark">
                                            <span>Đặt ngay</span>
                                        </button>
                                    </div>
                                </div>
                            @endguest
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 