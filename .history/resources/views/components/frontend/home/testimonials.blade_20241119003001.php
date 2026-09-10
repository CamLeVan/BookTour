@props(['testimonials'])

<section class="testimonials">
    <div class="background bg-img bg-fixed section-padding pb-0" data-background="{{ asset('storage/img/slider/15.jpg') }}" data-overlay-dark="5">
        <div class="container">
            <div class="row">
                <!-- Call Now -->
                <div class="col-md-5 mb-30 mt-30">
                    <p><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i></p>
                    <h5>We Provide Top Destinations Especially For You Book Now and Enjoy!</h5>
                    <div class="phone-call mb-10">
                        <div class="icon color-1"><span class="flaticon-phone-call"></span></div>
                        <div class="text">
                            <p class="color-1">Call Now</p>
                            <a class="color-1" href="tel:855-333-4444">855 333 4444</a>
                        </div>
                    </div>
                    <p><i class="ti-check"></i><small>Call us, it's toll-free.</small></p>
                </div>
                <!-- Testimonials Box -->
                <div class="col-md-5 offset-md-2">
                    <div class="testimonials-box">
                        <div class="head-box">
                            <h6>Đánh giá</h6>
                            <h4>Khách hàng nói gì về chúng tôi</h4>
                        </div>
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <p>Chuyến đi Hạ Long thật tuyệt vời. Dịch vụ chu đáo, hướng dẫn viên nhiệt tình. Cảnh đẹp, ẩm thực ngon. Chắc chắn sẽ quay lại!</p>
                                <div class="info">
                                    <div class="author-img"> <img src="{{ asset('frontend/img/team/04.png') }}" alt=""> </div>
                                    <div class="cont">
                                        <div class="rating">
                                            <i class="star active"></i>
                                            <i class="star active"></i>
                                            <i class="star active"></i>
                                            <i class="star active"></i>
                                            <i class="star active"></i>
                                        </div>
                                        <h6>Nguyễn Văn A</h6>
                                        <span>Khách du lịch</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Thêm các đánh giá khác tương tự -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>