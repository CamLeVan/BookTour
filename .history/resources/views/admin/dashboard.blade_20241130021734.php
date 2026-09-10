@extends('layouts.admin')

@section('title', 'Bảng Điều Khiển | HC Travel Admin')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Bảng Điều Khiển</h4>
        </div>
    </div>

    <!-- Biểu đồ doanh số -->
    <div class="row">
        <div class="col-md-12 col-xl-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                            <i data-feather="git-commit" class="widgets-icons"></i>
                        </div>
                        <h5 class="card-title mb-0">Báo Cáo Doanh Số</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div id="chart-money" class="apex-charts"></div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                            <i data-feather="pie-chart" class="widgets-icons"></i>
                        </div>
                        <h5 class="card-title mb-0">Doanh Số Theo Khu Vực</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div id="sales-country" class="apex-charts"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Tour Bán Chạy Nhất -->
        <div class="col-md-6 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                            <i data-feather="cpu" class="widgets-icons"></i>
                        </div>
                        <h5 class="card-title mb-0">Tour Bán Chạy Nhất</h5>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="list-group custom-group">
                        @forelse($topTours as $tour)
                            <li class="list-group-item align-items-center d-flex justify-content-between">
                                <div class="product-list">
                                    <img class="avatar-md p-1 rounded-circle bg-primary-subtle img-fluid me-3"
                                        src="{{ asset('images/tours/' . $tour->image) }}" 
                                        alt="{{ $tour->name }}" />

                                    <div class="product-body align-self-center">
                                        <h6 class="m-0 fw-semibold">{{ $tour->name }}</h6>
                                        <p class="mb-0 mt-1 text-muted">{{ $tour->destination->name ?? 'Chưa có điểm đến' }}</p>
                                    </div>
                                </div>

                                <div class="product-price">
                                    <h6 class="m-0 fw-semibold">{{ number_format($tour->price) }}đ</h6>
                                    <p class="mb-0 mt-1 text-muted">{{ $tour->bookings_count ?? 0 }} Đã bán</p>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-center">Chưa có tour nào được đặt</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Tỷ lệ khách hàng quay lại -->
        <div class="col-md-6 col-xl-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                            <i data-feather="bar-chart" class="widgets-icons"></i>
                        </div>
                        <h5 class="card-title mb-0">Tỷ Lệ Khách Hàng Quay Lại</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div id="repeat-customer" class="apex-charts"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Apexcharts JS -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>
    <!-- Khởi tạo Widgets JS -->
    <script src="{{ asset('assets/js/pages/ecommerce-dashboard.init.js') }}"></script>
@endpush
