<section class="about cover section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-30 animate-box" data-animate-effect="fadeInUp">
                <div class="section-subtitle">The best travel agency</div>
                <div class="section-title">Discover the <span>world</span> with our guide</div>
                <p>You can choose any country with good tourism. Agency elementum sesue the aucan vestibulum aliquam justo in sapien rutrum volutpat. Donec in quis the pellentesque velit. Donec id velit ac arcu posuere blane.</p>
                <p>Hotel ut nisl quam nestibulum ac quam nec odio elementum ceisue the miss varius natoque penatibus et magnis dis parturient monte.</p>
                <ul class="list-unstyled about-list mb-30">
                    <li>
                        <div class="about-list-icon"> <span class="ti-check"></span> </div>
                        <div class="about-list-text">
                            <p>20 Years of Experience</p>
                        </div>
                    </li>
                    <li>
                        <div class="about-list-icon"> <span class="ti-check"></span> </div>
                        <div class="about-list-text">
                            <p>150+ Tour Destinations</p>
                        </div>
                    </li>
                </ul>
                <a href="{{ route('frontend.about') }}" class="butn-dark2"><span>Learn More</span></a>
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