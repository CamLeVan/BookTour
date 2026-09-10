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

            {{-- Booking Form --}}
            <div class="col-md-4">
                <div class="sidebar">
                    <div class="right-sidebar">
                        <div class="right-sidebar item">
                            <h3>
                                <span class="right-sidebar item__price">
                                    {{ number_format($tour->price) }}đ
                                </span>
                            </h3>
                            <form method="POST" action="{{ route('frontend.bookings.store') }}" class="right-sidebar item-form">
                                @csrf
                                <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                                <div class="row">
                                    @guest
                                        <div class="col-12 mb-3">
                                            <div class="alert alert-warning">
                                                Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để đặt tour
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12 form-group input1_inner">
                                            <input type="date" 
                                                   name="booking_date" 
                                                   class="form-control input datepicker" 
                                                   placeholder="Ngày đi" 
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
                                    @endguest
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 