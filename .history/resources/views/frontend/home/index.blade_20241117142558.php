@extends('layouts.frontend')

@section('content')
    <!-- Header Video -->
    <header class="header">
        <div class="video-fullscreen-wrap">
            <div class="video-fullscreen-video" data-overlay-dark="5">
                <video playsinline="" autoplay="" loop="" muted="">
                    <source src="https://duruthemes.com/demo/html/travol/travel-video.mp4" type="video/mp4">
                    <source src="https://duruthemes.com/demo/html/travol/travel-video.webm" type="video/webm">
                </video>
            </div>
            <div class="v-middle caption overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <h4>Let's travel the world with us</h4>
                            <h1>Explore The World With <span>HC Travel</span></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Tour Search -->
    <div class="booking-wrapper">
        <div class="container">
            <div class="tour-inner clearfix form-inline justify-content-center">
                <form action="{{ route('frontend.tours.index') }}" class="form1 clearfix">
                    <div class="col1 c1">
                        <div class="input2_wrapper">
                            <label>Where to?</label>
                            <div class="input2_inner">
                                <input type="text" class="form-control input" placeholder="Where to?">
                            </div>
                        </div>
                    </div>
                    <div class="col1 c2">
                        <div class="select1_wrapper">
                            <label>Destinations</label>
                            <div class="select1_inner">
                                <select class="select2 select" style="width: 100%">
                                    <option value="0">Destinations</option>
                                    <option value="1">Greece</option>
                                    <option value="2">London</option>
                                    <option value="3">Maldives</option>
                                    <option value="4">Paris</option>
                                    <option value="5">Rome</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col1 c4">
                        <div class="select1_wrapper">
                            <label>Duration</label>
                            <div class="select1_inner">
                                <select class="select2 select" style="width: 100%">
                                    <option value="0">Duration</option>
                                    <option value="1">1 Day Tour</option>
                                    <option value="2">2-4 Days Tour</option>
                                    <option value="3">5-7 Days Tour</option>
                                    <option value="4">7+ Days Tour</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col1 c5">
                        <button type="submit" class="btn-form1-submit"><i class="ti-search"></i> Find Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- About -->
    <section class="about cover section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-30 animate-box" data-animate-effect="fadeInUp">
                    <div class="section-subtitle">The best travel agency</div>
                    <div class="section-title">Discover the <span>world</span> with our guide</div>
                    <p>You can choose any country with good tourism. Agency elementum sesue the aucan vestibulum aliquam justo in sapien rutrum volutpat. Donec in quis the pellentesque velit. Donec id velit ac arcu posuere blane.</p>
                    <p>Hotel ut nisl quam nestibulum ac quam nec odio elementum ceisue the miss varius natoque penatibus et magnis dis parturient monte.</p>
                    <!-- ... rest of about section ... -->
                </div>
                <div class="col-md-5 offset-md-1 animate-box" data-animate-effect="fadeInUp">
                    <div class="img-exp">
                        <div class="about-img">
                            <div class="img"> <img src="{{ asset('frontend/img/about.jpg') }}" class="img-fluid" alt=""> </div>
                        </div>
                        <div id="circle">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="300px" height="300px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve">
                                <defs>
                                    <path id="circlePath" d=" M 150, 150 m -60, 0 a 60,60 0 0,1 120,0 a 60,60 0 0,1 -120,0 " />
                                </defs>
                                <circle cx="150" cy="100" r="75" fill="none" />
                                <g>
                                    <use xlink:href="#circlePath" fill="none" />
                                    <text fill="#0f2454">
                                        <textPath xlink:href="#circlePath"> . travel agency . travel agency </textPath>
                                    </text>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tours Section -->
    <section class="tours1 section-padding bg-lightnav" data-scroll-index="1">
        <!-- ... Tours content ... -->
    </section>

    <!-- Blog Section -->
    <section class="blog section-padding bg-navy">
        <!-- ... Blog content ... -->
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <!-- ... Testimonials content ... -->
    </section>

    <!-- Clients Section -->
    <section class="clients">
        <!-- ... Clients content ... -->
    </section>
@endsection