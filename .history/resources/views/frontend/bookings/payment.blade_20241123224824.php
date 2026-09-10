@extends('layouts.frontend')

@section('content')
<div class="payment-page section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="payment-card">
                    <!-- Header -->
                    <div class="payment-header">
                        <h4>Xác nhận thanh toán</h4>
                        <p class="text-muted">Vui lòng kiểm tra thông tin và xác nhận thanh toán</p>
                    </div>

                    <!-- Booking Details -->
                    <div class="booking-info">
                        <div class="tour-name">
                            <h5>{{ $booking->tour->name }}</h5>
                            <span class="badge badge-primary">Tour ID: #{{ $booking->id }}</span>
                        </div>

                        <div class="details-grid">
                            <div class="detail-item">
                                <i class="ti-calendar"></i>
                                <div>
                                    <span class="label">Ngày khởi hành</span>
                                    <span class="value">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}</span>
                                </div>
                            </div>

                            <div class="detail-item">
                                <i class="ti-user"></i>
                                <div>
                                    <span class="label">Số người</span>
                                    <span class="value">{{ $booking->adults }} người lớn, {{ $booking->children }} trẻ em</span>
                                </div>
                            </div>

                            @if($booking->notes)
                            <div class="detail-item full-width">
                                <i class="ti-notepad"></i>
                                <div>
                                    <span class="label">Ghi chú</span>
                                    <span class="value">{{ $booking->notes }}</span>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Price Summary -->
                        <div class="price-summary">
                            <div class="price-row">
                                <span>Người lớn ({{ $booking->adults }} x {{ number_format($booking->tour->price) }}đ)</span>
                                <span>{{ number_format($booking->adults * $booking->tour->price) }}đ</span>
                            </div>
                            <div class="price-row">
                                <span>Trẻ em ({{ $booking->children }} x {{ number_format($booking->tour->price * 0.5) }}đ)</span>
                                <span>{{ number_format($booking->children * $booking->tour->price * 0.5) }}đ</span>
                            </div>
                            <div class="price-total">
                                <span>Tổng tiền</span>
                                <span class="total-amount">{{ number_format($booking->total_price) }}đ</span>
                            </div>
                        </div>

                        <!-- Payment Actions -->
                        <div class="payment-actions">
                            <form action="{{ route('frontend.bookings.process-payment', $booking) }}" method="POST">
                                @csrf
                                <button type="submit" name="status" value="success" class="btn-success">
                                    <i class="ti-check"></i>
                                    Xác nhận thanh toán
                                </button>
                                <button type="submit" name="status" value="failed" class="btn-danger">
                                    <i class="ti-close"></i>
                                    Hủy thanh toán
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 