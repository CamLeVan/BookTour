@extends('layouts.frontend')

@section('content')
<div class="booking-review section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card review-card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Xác nhận đặt tour</h3>
                        
                        {{-- Tour Info --}}
                        <div class="tour-info">
                            <div class="tour-header">
                                <h4>{{ $tour->name }}</h4>
                                <p class="booking-date">
                                    <i class="ti-calendar"></i> 
                                    Ngày đi: {{ \Carbon\Carbon::parse($bookingData['booking_date'])->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>

                        {{-- Booking Details --}}
                        <div class="booking-details">
                            <h5 class="section-title">Chi tiết đặt chỗ</h5>
                            <div class="detail-item">
                                <span>Người lớn</span>
                                <span class="price">{{ $bookingData['adults'] }} × {{ number_format($tour->price) }}đ</span>
                            </div>
                            @if($bookingData['children'] > 0)
                            <div class="detail-item">
                                <span>Trẻ em</span>
                                <span class="price">{{ $bookingData['children'] }} × {{ number_format($tour->price * 0.5) }}đ</span>
                            </div>
                            @endif
                        </div>

                        {{-- Total Amount --}}
                        <div class="total-amount">
                            <div class="detail-item total">
                                <span>Tổng tiền</span>
                                <span class="price">{{ number_format($bookingData['total_amount']) }}đ</span>
                            </div>
                        </div>

                        {{-- Notes if any --}}
                        @if(!empty($bookingData['notes']))
                        <div class="booking-notes">
                            <h5 class="section-title">Ghi chú</h5>
                            <p>{{ $bookingData['notes'] }}</p>
                        </div>
                        @endif

                        {{-- Actions --}}
                        <div class="action-buttons">
                            <a href="{{ route('frontend.bookings.create', ['tour' => $tour]) }}" class="btn btn-outline">
                                <i class="ti-arrow-left"></i> Quay lại
                            </a>
                            <form action="{{ route('frontend.bookings.store', ['tour' => $tour]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    Xác nhận đặt tour <i class="ti-arrow-right"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
/* Section Padding */
.booking-review {
    padding: 80px 0;
    background: linear-gradient(rgba(255,255,255,.9), rgba(255,255,255,.9)), url('/images/pattern.png');
}

/* Card Styling */
.review-card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.review-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(170,132,83,0.15);
}

.card-body {
    padding: 40px;
}

/* Tour Info Section */
.tour-info {
    background: linear-gradient(45deg, #f8f9fa, #fff);
    padding: 25px;
    border-radius: 15px;
    border: 1px solid rgba(170,132,83,0.1);
    margin-bottom: 30px;
}

.tour-header h4 {
    color: #aa8453;
    font-size: 1.5em;
    margin-bottom: 15px;
    font-weight: 600;
}

.booking-date {
    color: #666;
    font-size: 1.1em;
    margin-bottom: 0;
}

.booking-date i {
    color: #aa8453;
    margin-right: 8px;
}

/* Booking Details */
.booking-details {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 30px;
}

.section-title {
    color: #444;
    font-size: 1.2em;
    margin-bottom: 20px;
    font-weight: 600;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #eee;
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-item .price {
    font-weight: 600;
    color: #666;
}

/* Total Amount */
.total-amount {
    background: #fff;
    padding: 20px;
    border-radius: 15px;
    margin: 30px 0;
    border: 2px solid #aa8453;
}

.total-amount .detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #eee;
}

.total-amount .detail-item:last-child {
    border-bottom: none;
}

.total-amount .detail-item .price {
    font-weight: 600;
    color: #666;
}

/* Booking Notes */
.booking-notes {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 30px;
}

.booking-notes .section-title {
    color: #444;
    font-size: 1.2em;
    margin-bottom: 20px;
    font-weight: 600;
}

.booking-notes p {
    color: #666;
    font-size: 1.1em;
    margin-bottom: 0;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 30px;
}

.action-buttons .btn {
    flex: 1;
    margin-left: 10px;
    margin-right: 10px;
}

.action-buttons .btn:first-child {
    margin-left: 0;
}

.action-buttons .btn:last-child {
    margin-right: 0;
}
</style>
@endpush 