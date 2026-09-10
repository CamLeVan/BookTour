<div class="modal fade" id="confirmDeleteModal" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($selectedBooking)
                    <p>Bạn có chắc chắn muốn xóa đơn đặt tour này?</p>
                    <div class="alert alert-warning">
                        <strong>Tour:</strong> {{ $selectedBooking->tour->name }}<br>
                        <strong>Khách hàng:</strong> {{ $selectedBooking->user->name }}<br>
                        <strong>Ngày đặt:</strong> {{ $selectedBooking->booking_date->format('d/m/Y') }}
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-danger" wire:click="deleteBooking">Xóa</button>
            </div>
        </div>
    </div>
</div>
