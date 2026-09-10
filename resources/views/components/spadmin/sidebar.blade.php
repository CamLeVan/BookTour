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
                <li class="menu-title">spadmin</li>

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
                                <a class="tp-link" href="{{ route('spadmin.dashboard') }}">Tổng quan</a>
                            </li>
                        </ul>
                    </div>
                </li>

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
                                <a class="tp-link" href="{{ route('spadmin.tours.tour-list-sp') }}">Danh sách Tour</a>
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
                                <a class="tp-link" href="{{ route('spadmin.bookings.index') }}">Danh sách đặt Tour</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Quản lý Nhà Cung Cấp -->
                <li>
                    <a href="#sidebarSuppliers" data-bs-toggle="collapse">
                        <i data-feather="briefcase"></i>
                        <span> Quản lý Nhà Cung Cấp </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarSuppliers">
                        <ul class="nav-second-level">
                            <li>
                                <a class="tp-link" href="{{ route('spadmin.admins.index') }}">Danh sách Nhà Cung Cấp</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Quản lý Khách Hàng -->
                <li>
                    <a href="#sidebarCustomers" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Quản lý Khách Hàng </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCustomers">
                        <ul class="nav-second-level">
                            <li>
                                <a class="tp-link" href="{{ route('spadmin.managecustomerlist.customerlistsp') }}">Danh
                                    sách Khách Hàng</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Thống kê & Báo cáo -->
                <li>
                    <a href="#sidebarReports" data-bs-toggle="collapse">
                        <i data-feather="bar-chart-2"></i>
                        <span> Thống kê & Báo cáo </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarReports">
                        <ul class="nav-second-level">
                            <li>
                                <a class="tp-link" href="{{ route('spadmin.revenue.revenuereport') }}">Báo cáo Doanh
                                    Thu</a>
                            </li>
                            <li>
                                <a class="tp-link" href="{{ route('spadmin.user.report') }}">Báo cáo Người Dùng</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Hệ thống -->
                <li>
                    <a href="#sidebarSystem" data-bs-toggle="collapse">
                        <i data-feather="settings"></i>
                        <span> Hệ thống </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarSystem">
                        <ul class="nav-second-level">
                            <li>
                                <a class="tp-link" href="#">Cài đặt Hệ Thống</a>
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
