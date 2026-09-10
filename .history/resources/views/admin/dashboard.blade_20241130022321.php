@extends('layouts.admin')

@section('title', 'Bảng Điều Khiển | HC Travel Admin')

@section('content')
<div class="container-fluid">
    <!-- Thống kê -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Tổng Doanh Thu</h5>
                    <h3>{{ isset($statistics['total_revenue']) ? number_format($statistics['total_revenue']) : 0 }}đ</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Tổng Đơn Đặt Tour</h5>
                    <h3>{{ $statistics['total_bookings'] ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Tổng Khách Hàng</h5>
                    <h3>{{ $statistics['total_customers'] ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Khách Hàng Quay Lại</h5>
                    <h3>{{ $statistics['repeat_customers'] ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Tour Bán Chạy -->
    <div class="row">
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
                    @if(isset($topTours) && count($topTours) > 0)
                        <ul class="list-group custom-group">
                            @foreach($topTours as $tour)
                                <li class="list-group-item align-items-center d-flex justify-content-between">
                                    <div class="product-list">
                                        <img class="avatar-md p-1 rounded-circle bg-primary-subtle img-fluid me-3"
                                            src="{{ asset('images/tours/' . $tour->image) }}" 
                                            alt="{{ $tour->name }}" />

                                        <div class="product-body align-self-center">
                                            <h6 class="m-0 fw-semibold">{{ $tour->name }}</h6>
                                            <p class="mb-0 mt-1 text-muted">{{ optional($tour->destination)->name ?? 'Chưa có điểm đến' }}</p>
                                        </div>
                                    </div>

                                    <div class="product-price">
                                        <h6 class="m-0 fw-semibold">{{ number_format($tour->price) }}đ</h6>
                                        <p class="mb-0 mt-1 text-muted">{{ $tour->bookings_count ?? 0 }} Đã bán</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-center py-3">
                            <p class="text-muted mb-0">Chưa có tour nào được đặt</p>
                        </div>
                    @endif
                </div>
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
