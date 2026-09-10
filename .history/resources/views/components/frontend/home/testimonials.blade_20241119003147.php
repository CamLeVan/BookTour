<section class="testimonials">
    <div class="background bg-img bg-fixed section-padding pb-0" data-background="{{ asset('frontend/img/slider/2.jpg') }}" data-overlay-dark="5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="testimonials-box">
                        <div class="head-box">
                            <h6>Đánh giá </h6>
                            <h4>Khách hàng nói gì về chúng tôi</h4>
                        </div>
                        <div class="owl-carousel owl-theme">
                            @foreach($testimonials as $testimonial)
                            <div class="item">
                                <span class="quote"><img src="{{ asset('frontend/img/quot.png') }}" alt=""></span>
                                <p>{{ $testimonial->content }}</p>
                                <div class="info">
                                    <div class="author-img"> 
                                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt=""> 
                                    </div>
                                    <div class="cont">
                                        <h6>{{ $testimonial->name }}</h6>
                                        <span>{{ $testimonial->position }}</span>
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