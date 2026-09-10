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
                            <p><i class="ti-calendar"></i> Ngày đi: {{ \Carbon\Carbon::parse($bookingData['booking_date'])->format('d/m/Y') }}</p>
                        </div>

                        {{-- Booking Details --}}
                        <div class="booking-details mb-4">
                            <h5>Chi tiết đặt chỗ</h5>
                            <div class="row">
                                <div class="col-6">Người lớn:</div>
                                <div class="col-6 text-end">{{ $bookingData['adults'] }} × {{ number_format($tour->price) }}đ</div>
                            </div>
                            @if($bookingData['children'] > 0)
                            <div class="row">
                                <div class="col-6">Trẻ em:</div>
                                <div class="col-6 text-end">{{ $bookingData['children'] }} × {{ number_format($tour->price * 0.5) }}đ</div>
                            </div>
                            @endif
                        </div>

                        {{-- Total Amount --}}
                        <div class="total-amount mb-4">
                            <div class="row">
                                <div class="col-6"><strong>Tổng tiền:</strong></div>
                                <div class="col-6 text-end">
                                    <strong class="text-primary">{{ number_format($bookingData['total_amount']) }}đ</strong>
                                </div>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('frontend.bookings.create', $tour) }}" class="btn btn-outline-secondary">
                                <i class="ti-arrow-left"></i> Quay lại
                            </a>
                            <form action="{{ route('frontend.bookings.store', $tour) }}" method="POST">
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
    /* Add your styles here */
</style>
@endpush 