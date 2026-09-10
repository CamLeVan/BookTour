<!-- Left Sidebar Start -->
<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <div class="logo-box">
                <a class="logo logo-light" href="{{ url('/') }}">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/favicon.png') }}" alt="" height="22" />
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="24" />
                    </span>
                </a>
                <a class="logo logo-dark" href="{{ url('/') }}">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/favicon.png') }}" alt="" height="22" />
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-b.png') }}" alt="" height="24" />
                    </span>
                </a>
            </div>

            <ul id="side-menu">
                <li class="menu-title">Menu</li>

                <!-- Dashboard -->
                <li>
                    <a href="#sidebarDashboards" data-bs-toggle="collapse">
                        <i data-feather="home"></i>
                        <span> Dashboard </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarDashboards">
                        <ul class="nav-second-level">
                            <li>
                                <a class="tp-link" href="{{ route('admin.dashboard') }}">Tổng quan</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title">Admin</li>

                <!-- Quản lý Tour -->
                <li>
                    <a href="#sidebarTours" data-bs-toggle="collapse">
                        <i data-feather="map"></i>
                        <span> Quản lý Tour </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarTours">
                        <ul class="nav-second-level">
                            <li>
                                <a class="tp-link" href="{{ route('admin.tours.create') }}">Tạo Tour Mới</a>
                            </li>
                            <li>
                                <a class="tp-link" href="{{ route('admin.tours.index') }}">Danh sách Tour</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <!-- Quản lý Đặt Tour -->
                <li>
                    <a href="#sidebarBookings" data-bs-toggle="collapse">
                        <i data-feather="calendar"></i>
                        <span> Quản lý Đặt Tour </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarBookings">
                        <ul class="nav-second-level">
                            <li>
                                <a class="tp-link" href="{{ route('admin.bookings.index') }}">
                                    <i class="fas fa-list-ul me-1"></i>
                                    Danh sách Đặt Tour
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <!-- Quản lý Đánh Giá & Nhận Xét -->
                <li>
                    <a href="{{ route('admin.reviews.index') }}" class="tp-link">
                        <i data-feather="star"></i>
                        <span> Đánh giá & Nhận xét </span>
                    </a>
                </li>

                <!-- Quản lý Mã Khuyến Mãi -->
                <li>
                    <a href="#sidebarVouchers" data-bs-toggle="collapse">
                        <i data-feather="tag"></i>
                        <span> Khuyến Mãi & Ưu Đãi </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarVouchers">
                        <ul class="nav-second-level">
                            <li>
                                <a class="tp-link" href="{{ route('admin.vouchers.index') }}">Danh sách Mã Giảm Giá</a>
                            </li>
                            <li>
                                <a class="tp-link" href="{{ route('admin.vouchers.create') }}">Tạo Mã Mới</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Quản lý Tài Chính & Dòng Tiền -->
                <li>
                    <a href="#sidebarFinancial" data-bs-toggle="collapse">
                        <i data-feather="dollar-sign"></i>
                        <span> Tài Chính & Dòng Tiền </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarFinancial">
                        <ul class="nav-second-level">
                            <li>
                                <a class="tp-link" href="{{ route('admin.financial.index') }}">Báo cáo Kế toán Dòng tiền</a>
                            </li>
                            <li>
                                <a class="tp-link" href="{{ route('admin.financial.refunds') }}">Quản lý Yêu cầu Hoàn tiền</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Quản lý Tài Khoản -->
                <li>
                    <a href="#sidebarAccount" data-bs-toggle="collapse">
                        <i data-feather="user"></i>
                        <span> Quản lý Tài Khoản </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAccount">
                        <ul class="nav-second-level">
                            <li>
                                <a class="tp-link" href="{{ route('admin.accounts.up-profile') }}">Cập nhật Thông
                                    tin</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Thống kê -->
                <li>
                    <a href="#sidebarReports" data-bs-toggle="collapse">
                        <i data-feather="bar-chart-2"></i>
                        <span> Thống kê </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarReports">
                        <ul class="nav-second-level">
                            <li>
                                <a class="tp-link" href="#">Thống kê Doanh thu</a>
                            </li>
                            <li>
                                <a class="tp-link" href="#">Thống kê Lượt Đặt</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->
