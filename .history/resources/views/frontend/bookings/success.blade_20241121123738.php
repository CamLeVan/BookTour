@extends('layouts.frontend')

@section('content')
<div class="booking-success section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="icon mb-4">
                    <i class="ti-check-box text-success" style="font-size: 48px;"></i>
                </div>
                <h2 class="mb-4">Đặt Tour Thành Công!</h2>
                <div class="booking-details mb-4">
                    <h4>{{ $booking->tour->name }}</h4>
                    <p>Mã đặt tour: #{{ $booking->id }}</p>
                    <p>Ngày khởi hành: {{ $booking->booking_date->format('d/m/Y') }}</p>
                    <p>Số người: {{ $booking->adults }} người lớn, {{ $booking->children }} trẻ em</p>
                    <p>Tổng tiền: {{ number_format($booking->total_price) }} VNĐ</p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('frontend.home') }}" class="butn-dark"><span>Về Trang Chủ</span></a>
                    <a href="{{ route('frontend.tours.index') }}" class="butn-dark"><span>Xem Tour Khác</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 