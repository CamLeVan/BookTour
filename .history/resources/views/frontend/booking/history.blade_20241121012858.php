@extends('layouts.frontend')

@section('content')
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-subtitle">Lịch sử</div>
                <div class="section-title">Đặt tour của bạn</div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($bookings->isEmpty())
                    <p>Bạn chưa có đơn đặt tour nào.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tour</th>
                                    <th>Ngày đặt</th>
                                    <th>Số người</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Ghi chú</th>
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
                                        <td>
                                            @switch($booking->status)
                                                @case('pending')
                                                    <span class="badge bg-warning">Chờ xác nhận</span>
                                                    @break
                                                @case('confirmed')
                                                    <span class="badge bg-success">Đã xác nhận</span>
                                                    @break
                                                @case('cancelled')
                                                    <span class="badge bg-danger">Đã hủy</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>{{ $booking->notes }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .table {
        margin-top: 30px;
    }
    .badge {
        padding: 8px 12px;
        border-radius: 4px;
    }
    .table > tbody > tr > td {
        vertical-align: middle;
    }
    .table a {
        color: #aa8453;
        text-decoration: none;
    }
    .table a:hover {
        color: #8b6b42;
    }
</style>
@endpush 