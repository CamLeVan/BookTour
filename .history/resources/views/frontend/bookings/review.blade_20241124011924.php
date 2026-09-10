@extends('layouts.frontend')

@section('content')
<div class="booking-review section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Xác nhận đặt tour</h3>
                        
                        {{-- Tour Info --}}
                        <div class="tour-info mb-4">
                            <h4>{{ $tour->name }}</h4>
                            <p><i class="ti-calendar"></i> Ngày đi: {{ $pendingBooking->booking_date->format('d/m/Y') }}</p>
                        </div>

                        {{-- Booking Details --}}
                        <div class="booking-details mb-4">
                            <h5>Chi tiết đặt chỗ</h5>
                            <div class="row">
                                <div class="col-6">Người lớn:</div>
                                <div class="col-6 text-end">{{ $pendingBooking->adults }} × {{ number_format($tour->price) }}đ</div>
                            </div>
                            @if($pendingBooking->children > 0)
                            <div class="row">
                                <div class="col-6">Trẻ em:</div>
                                <div class="col-6 text-end">{{ $pendingBooking->children }} × {{ number_format($tour->price * 0.5) }}đ</div>
                            </div>
                            @endif
                        </div>

                        {{-- Total Amount --}}
                        <div class="total-amount">
                            <div class="row">
                                <div class="col-6"><h5>Tổng tiền:</h5></div>
                                <div class="col-6 text-end">
                                    <h4 class="text-primary">{{ number_format($pendingBooking->total_amount) }}đ</h4>
                                </div>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="actions mt-4">
                            <form action="{{ route('frontend.bookings.confirm', $pendingBooking) }}" method="POST">
                                @csrf
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('frontend.tours.show', $tour) }}" 
                                       class="btn btn-outline-secondary">
                                        <i class="ti-arrow-left"></i> Quay lại
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        Tiếp tục thanh toán <i class="ti-arrow-right"></i>
                                    </button>
                                </div>
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
.booking-review {
    padding: 60px 0;
}

.card {
    border: none;
    box-shadow: 0 0 30px rgba(0,0,0,0.1);
    border-radius: 15px;
}

.card-body {
    padding: 30px;
}

.tour-info {
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.tour-info h4 {
    color: #aa8453;
    margin-bottom: 10px;
}

.booking-details {
    padding: 20px 0;
    border-bottom: 1px solid #eee;
}

.booking-details .row {
    margin-bottom: 10px;
}

.total-amount {
    padding-top: 20px;
}

.total-amount h4 {
    color: #aa8453;
    font-weight: 700;
}

.btn {
    padding: 12px 25px;
    border-radius: 8px;
}

.btn-primary {
    background: #aa8453;
    border-color: #aa8453;
}

.btn-primary:hover {
    background: #957346;
    border-color: #957346;
}

.btn-outline-secondary {
    color: #666;
    border-color: #ddd;
}

.btn-outline-secondary:hover {
    background: #f8f9fa;
    border-color: #ddd;
    color: #444;
}
</style>
@endpush 