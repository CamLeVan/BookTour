<section class="testimonials">
    <div class="background bg-img bg-fixed section-padding pb-0" data-background="{{ asset('frontend/img/slider/15.jpg') }}" data-overlay-dark="5">
        <div class="container">
            <div class="row">
                <!-- Call Now  -->
                <div class="col-md-5 mb-30 mt-30">
                    <p><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i></p>
                    <h5>Chúng tôi cung cấp những điểm đến tuyệt vời nhất cho bạn. Đặt ngay!</h5>
                    <div class="phone-call mb-10">
                        <div class="icon color-1"><span class="flaticon-phone-call"></span></div>
                        <div class="text">
                            <p class="color-1">Gọi ngay</p> 
                            <a class="color-1" href="tel:0123456789">0123 456 789</a>
                        </div>
                    </div>
                    <p><i class="ti-check"></i><small>Gọi cho chúng tôi, hoàn toàn miễn phí.</small></p>
                </div>

                <!-- Testimonials -->
                <div class="col-md-5 offset-md-2">
                    <div class="testimonials-box">
                        <div class="head-box">
                            <h6>Đánh giá</h6>
                            <h4>Khách hàng nói gì?</h4>
                        </div>
                        <div class="owl-carousel owl-theme">
                            @foreach($testimonials as $review)
                            <div class="item">
                                <p>{{ $review->comment }}</p>
                                <div class="info">
                                    <div class="author-img"> 
                                        <img src="{{ asset('frontend/img/default-avatar.jpg') }}" alt=""> 
                                    </div>
                                    <div class="cont">
                                        <div class="rating"> 
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="star {{ $i <= $review->rating ? 'active' : '' }}"></i>
                                            @endfor
                                        </div>
                                        <h6>{{ $review->user->name }}</h6>
                                        <span>{{ $review->tour->name }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>