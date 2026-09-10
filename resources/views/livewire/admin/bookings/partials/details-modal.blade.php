<div class="modal fade" id="detailsModal" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chi tiết đơn đặt tour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @if ($selectedBooking)
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Thông tin tour</h6>
                            <p><strong>Tên tour:</strong> {{ $selectedBooking->tour->name }}</p>
                            <p><strong>Ngày đặt:</strong> {{ $selectedBooking->booking_date->format('d/m/Y') }}</p>
                            <p><strong>Số người:</strong> {{ $selectedBooking->max_people }} người</p>
                            <p><strong>Tổng tiền:</strong> {{ number_format($selectedBooking->total_price) }} VNĐ</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Thông tin khách hàng</h6>
                            <p><strong>Tên:</strong> {{ $selectedBooking->user->name }}</p>
                            <p><strong>Email:</strong> {{ $selectedBooking->user->email }}</p>
                            <p><strong>Trạng thái:</strong>
                                <span class="badge bg-{{ $selectedBooking->status_color }}">
                                    {{ $selectedBooking->status_label }}
                                </span>
                            </p>
                            <p><strong>Thanh toán:</strong>
                                <span
                                    class="badge bg-{{ $selectedBooking->payment_status === 'paid' ? 'success' : 'warning' }}">
                                    {{ $selectedBooking->payment_status === 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                                </span>
                            </p>
                        </div>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
