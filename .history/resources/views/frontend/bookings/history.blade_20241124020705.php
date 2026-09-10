@extends('layouts.frontend')

@section('content')
<div class="booking-history section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="history-card">
                    <h3 class="text-center mb-4">Lịch Sử Đặt Tour</h3>

                    @if($bookings->isEmpty())
                        <div class="text-center empty-history">
                            <i class="ti-calendar"></i>
                            <p>Bạn chưa có đặt tour nào.</p>
                            <a href="{{ route('frontend.tours.index') }}" class="btn btn-primary">
                                Khám phá tour ngay
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table booking-table">
                                <thead>
                                    <tr>
                                        <th>Mã đặt tour</th>
                                        <th>Tour</th>
                                        <th>Ngày đi</th>
                                        <th>Số người</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Thanh toán</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                        <tr>
                                            <td>#{{ $booking->id }}</td>
                                            <td>
                                                <a href="{{ route('frontend.tours.show', $booking->tour) }}">
                                                    {{ $booking->tour->name }}
                                                </a>
                                            </td>
                                            <td>{{ $booking->booking_date->format('d/m/Y') }}</td>
                                            <td>
                                                {{ $booking->adults }} người lớn
                                                @if($booking->children > 0)
                                                    , {{ $booking->children }} trẻ em
                                                @endif
                                            </td>
                                            <td>{{ number_format($booking->total_amount) }} VNĐ</td>
                                            <td>
                                                <span class="status-badge {{ $booking->status }}">
                                                    @switch($booking->status)
                                                        @case('pending')
                                                            Chờ xử lý
                                                            @break
                                                        @case('confirmed')
                                                            Đã xác nhận
                                                            @break
                                                        @case('cancelled')
                                                            Đã hủy
                                                            @break
                                                        @default
                                                            {{ $booking->status }}
                                                    @endswitch
                                                </span>
                                            </td>
                                            <td>
                                                <span class="payment-badge {{ $booking->payment_status }}">
                                                    @switch($booking->payment_status)
                                                        @case('unpaid')
                                                            Chưa thanh toán
                                                            @break
                                                        @case('paid')
                                                            Đã thanh toán
                                                            @break
                                                        @default
                                                            {{ $booking->payment_status }}
                                                    @endswitch
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 