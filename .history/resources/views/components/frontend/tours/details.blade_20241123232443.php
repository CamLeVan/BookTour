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
                                <span class="right-sidebar item__from">From</span>
                                <span class="right-sidebar item__sale">{{ number_format($tour->price * 1.2) }}đ</span>
                                {{ number_format($tour->price) }}đ
                            </h3>

                            <form action="{{ route('frontend.tours.booking', $tour) }}" method="POST">
                                @csrf
                                <div class="row">
                                    @auth
                                        <div class="col-md-12 form-group">
                                            <label>Ngày khởi hành</label>
                                            <input type="date" 
                                                   name="booking_date" 
                                                   class="form-control"
                                                   min="{{ now()->addDays(2)->format('Y-m-d') }}"
                                                   value="{{ old('booking_date') }}"
                                                   required>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Người lớn</label>
                                            <input name="adults" type="number" min="1" value="{{ old('adults', 1) }}" required>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Trẻ em</label>
                                            <input name="children" type="number" min="0" value="{{ old('children', 0) }}">
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Ghi chú</label>
                                            <textarea name="notes" rows="4" placeholder="Yêu cầu đặc biệt..." rows="3">{{ old('notes') }}</textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <button type="submit" class="butn-dark">
                                                <span>Đặt Ngay</span>
                                            </button>
                                        </div>
                                    @else
                                        <div class="col-md-12">
                                            <div class="alert alert-info">
                                                Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để đặt tour
                                            </div>
                                        </div>
                                    @endauth
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 