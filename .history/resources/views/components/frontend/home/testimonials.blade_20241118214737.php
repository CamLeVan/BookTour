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
                            <h6>Testimonials</h6>
                            <h4>Travelers Reviews</h4>
                        </div>
                        <div class="owl-carousel owl-theme">
                            @foreach($testimonials as $testimonial)
                            <div class="item">
                                <p>{{ $testimonial->comment }}</p>
                                <div class="info">
                                    <div class="author-img">
                                        <img src="{{ $testimonial->user->profile_photo_url }}" alt="">
                                    </div>
                                    <div class="cont">
                                        <div class="rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="star {{ $i <= $testimonial->rating ? 'active' : '' }}"></i>
                                            @endfor
                                        </div>
                                        <h6>{{ $testimonial->user->name }}</h6>
                                        <span>Guest review</span>
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