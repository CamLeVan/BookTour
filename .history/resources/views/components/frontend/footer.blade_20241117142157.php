<footer class="footer clearfix">
    <div class="container">
        <!-- First footer -->
        <div class="first-footer">
            <div class="row">
                <div class="col-md-12">
                    <div class="links dark footer-contact-links">
                        <div class="footer-contact-links-wrapper">
                            <div class="footer-contact-link-wrapper">
                                <div class="image-wrapper footer-contact-link-icon">
                                    <div class="icon-footer">
                                        <i class="flaticon-phone-call"></i>
                                    </div>
                                </div>
                                <div class="footer-contact-link-content">
                                    <h6>Call us</h6>
                                    <p>+1 123-456-0606</p>
                                </div>
                            </div>
                            <div class="footer-contact-links-divider"></div>
                            <div class="footer-contact-link-wrapper">
                                <div class="image-wrapper footer-contact-link-icon">
                                    <div class="icon-footer">
                                        <i class="flaticon-message"></i>
                                    </div>
                                </div>
                                <div class="footer-contact-link-content">
                                    <h6>Write to us</h6>
                                    <p>info@hctravel.com</p>
                                </div>
                            </div>
                            <div class="footer-contact-links-divider"></div>
                            <div class="footer-contact-link-wrapper">
                                <div class="image-wrapper footer-contact-link-icon">
                                    <div class="icon-footer">
                                        <i class="flaticon-placeholder"></i>
                                    </div>
                                </div>
                                <div class="footer-contact-link-content">
                                    <h6>Address</h6>
                                    <p>24 King St, SC 29401 USA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Second footer -->
        <div class="second-footer">
            <div class="row">
                <!-- About & social icons -->
                <div class="col-md-4 widget-area">
                    <div class="widget clearfix">
                        <div class="footer-logo">
                            <img class="img-fluid" src="{{ asset('frontend/img/logo-light.png') }}" alt="">
                        </div>
                        <div class="widget-text">
                            <p>Experience the world with HC Travel - Your trusted companion for unforgettable journeys.</p>
                            <div class="social-icons">
                                <ul class="list-inline">
                                    <li><a href="#"><i class="ti-instagram"></i></a></li>
                                    <li><a href="#"><i class="ti-twitter"></i></a></li>
                                    <li><a href="#"><i class="ti-facebook"></i></a></li>
                                    <li><a href="#"><i class="ti-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Quick links -->
                <!-- Quick links -->
                <div class="col-md-3 offset-md-1 widget-area">
                    <div class="widget clearfix usful-links">
                        <h3 class="widget-title">Quick Links</h3>
                        <ul>
                            <li><a href="{{ route('frontend.about') }}">About</a></li>
                            <li><a href="{{ route('frontend.tours.index') }}">Tours</a></li>
                            <li><a href="{{ route('frontend.destinations.index') }}">Destinations</a></li>
                            <li><a href="{{ route('frontend.blog.index') }}">Blog</a></li>
                            <li><a href="{{ route('frontend.contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Subscribe -->
                <div class="col-md-4 widget-area">
                    <div class="widget clearfix">
                        <h3 class="widget-title">Subscribe</h3>
                        <p>Sign up for our monthly newsletter to stay informed about travel and tours</p>
                        <div class="widget-newsletter">
                            <form action="{{ route('frontend.newsletter.subscribe') }}" method="POST">
                                @csrf
                                <input type="email" name="email" placeholder="Email Address" required>
                                <button type="submit">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom footer -->
        <div class="bottom-footer-text">
            <div class="row copyright">
                <div class="col-md-12">
                    <p class="mb-0">©{{ date('Y') }} <a href="{{ route('frontend.home') }}">HC Travel</a>. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>