@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <h2>Lịch sử đặt tour</h2>
    
    @if($bookings->isEmpty())
        <p>Bạn chưa đặt tour nào.</p>
    @else
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
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
                        <td>
                            <a href="{{ route('frontend.tours.show', $booking->tour) }}">
                                {{ $booking->tour->name }}
                            </a>
                        </td>
                        <td>{{ $booking->booking_date->format('d/m/Y') }}</td>
                        <td>{{ $booking->number_of_people }}</td>
                        <td>{{ number_format($booking->total_price) }}đ</td>
                        <td>{{ $booking->status }}</td>
                        <td>
                            @if($booking->payment)
                                {{ $booking->payment->status }}
                            @else
                                Chưa thanh toán
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection 