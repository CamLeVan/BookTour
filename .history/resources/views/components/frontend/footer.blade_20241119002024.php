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
                                    <div class="icon-footer"> <i class="flaticon-phone-call"></i> </div>
                                </div>
                                <div class="footer-contact-link-content">
                                    <h6>Hotline</h6>
                                    <p>0123 456 789</p>
                                </div>
                            </div>
                            <div class="footer-contact-link-wrapper">
                                <div class="image-wrapper footer-contact-link-icon">
                                    <div class="icon-footer"> <i class="flaticon-message"></i> </div>
                                </div>
                                <div class="footer-contact-link-content">
                                    <h6>Email</h6>
                                    <p>info@hctravel.com</p>
                                </div>
                            </div>
                            <div class="footer-contact-link-wrapper">
                                <div class="image-wrapper footer-contact-link-icon">
                                    <div class="icon-footer"> <i class="flaticon-placeholder"></i> </div>
                                </div>
                                <div class="footer-contact-link-content">
                                    <h6>Địa chỉ</h6>
                                    <p>123 Đường ABC, Quận XYZ, TP.HCM</p>
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
                <div class="col-md-4 widget-area">
                    <div class="widget clearfix">
                        <div class="footer-logo">
                            <img class="img-fluid" src="{{ asset('frontend/img/logo-light.png') }}" alt="HC Travel">
                        </div>
                        <div class="widget-text">
                            <p>HC Travel - Đơn vị lữ hành uy tín hàng đầu Việt Nam, mang đến cho quý khách những trải nghiệm du lịch tuyệt vời nhất.</p>
                            <div class="social-icons">
                                <ul class="list-inline">
                                    <li><a href="#"><i class="ti-facebook"></i></a></li>
                                    <li><a href="#"><i class="ti-instagram"></i></a></li>
                                    <li><a href="#"><i class="ti-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 offset-md-1 widget-area">
                    <div class="widget clearfix usful-links">
                        <h3 class="widget-title">Liên kết</h3>
                        <ul>
                            <li><a href="{{ route('about') }}">Giới thiệu</a></li>
                            <li><a href="{{ route('tours') }}">Tour du lịch</a></li>
                            <li><a href="{{ route('blog') }}">Tin tức</a></li>
                            <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-4 widget-area">
                    <div class="widget clearfix">
                        <h3 class="widget-title">Đăng ký nhận tin</h3>
                        <p>Đăng ký để nhận thông tin ưu đãi mới nhất về các tour du lịch hấp dẫn</p>
                        <div class="widget-newsletter">
                            <form action="#">
                                <input type="email" placeholder="Email của bạn" required>
                                <button type="submit">Gửi</button>
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
                    <p class="mb-0">©{{ date('Y') }} <a href="#">HC Travel</a>. Đã đăng ký bản quyền.</p>
                </div>
            </div>
        </div>
    </div>
</footer>