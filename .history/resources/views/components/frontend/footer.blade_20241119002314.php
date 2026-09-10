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
                                    <h6>Hotline</h6>
                                    <p>+84 344 574 050</p>
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
                                    <h6>Email</h6>
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
                                    <h6>Địa chỉ</h6>
                                    <p>22 Nguyễn Tạo, Quận Ngũ Hành Sơn, TP.Đà Nẵng</p>
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
                            <p>Khám phá thế giới cùng HC Travel - Đối tác tin cậy cho những trải nghiệm không quên.</p>
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
                        <h3 class="widget-title">Liên kết hữu ích</h3>
                        <ul>
                            <li><a href="{{ route('frontend.about') }}">Giới thiệu</a></li>
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
                        <h3 class="widget-title">Đăng ký nhận tin</h3>
                        <p>Đăng ký để nhận thông tin ưu đãi mới nhất về các tour du lịch hấp dẫn</p>
                        <div class="widget-newsletter">
                            <form action="{{ route('frontend.newsletter.subscribe') }}" method="POST">
                                @csrf
                                <input type="email" name="email" placeholder="Email Address" required>
                                <button type="submit">Đăng ký</button>
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