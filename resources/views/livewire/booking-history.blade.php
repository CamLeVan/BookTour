
<div class="booking-history section-padding">
    <div class="container">
        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-lg-3">
                <div class="history-sidebar">
                    <div class="sidebar-header">
                        <h4>Bộ lọc</h4>
                    </div>

                    <div class="filter-section">
                        <h5>Trạng thái</h5>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" name="status[]" value="pending">
                                <span class="checkmark"></span>
                                <span class="status-badge pending">Chờ xác nhận</span>
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" name="status[]" value="confirmed">
                                <span class="checkmark"></span>
                                <span class="status-badge confirmed">Đã xác nhận</span>
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" name="status[]" value="completed">
                                <span class="checkmark"></span>
                                <span class="status-badge completed">Hoàn thành</span>
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" name="status[]" value="cancelled">
                                <span class="checkmark"></span>
                                <span class="status-badge cancelled">Đã hủy</span>
                            </label>
                        </div>
                    </div>

                    <div class="filter-section">
                        <h5>Thời gian</h5>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="radio" name="time" value="upcoming">
                                <span class="checkmark"></span>
                                Sắp tới
                            </label>
                            <label class="filter-option">
                                <input type="radio" name="time" value="past">
                                <span class="checkmark"></span>
                                Đã qua
                            </label>
                        </div>
                    </div>

                    <div class="filter-section">
                        <h5>Thanh toán</h5>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="radio" name="payment" value="paid">
                                <span class="checkmark"></span>
                                Đã thanh toán
                            </label>
                            <label class="filter-option">
                                <input type="radio" name="payment" value="unpaid">
                                <span class="checkmark"></span>
                                Chưa thanh toán
                            </label>
                        </div>
                    </div>
                </div>

                <div class="booking-stats">
                    <div class="stat-item">
                        <div class="stat-label">Tổng số tour</div>
                        <div class="stat-value">{{ $bookings->total() }}</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Đã hoàn thành</div>
                        <div class="stat-value completed">
                            {{ $bookings->where('status', 'completed')->count() }}
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Sắp tới</div>
                        <div class="stat-value upcoming">
                            {{ $bookings->where('booking_date', '>=', now())->count() }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="history-card">
                    <div class="history-header">
                        <div class="header-left">
                            <h3>Lịch Sử Đặt Tour</h3>
                            <p class="text-muted">Quản lý các tour bạn đã đặt</p>
                        </div>
                        <div class="header-right">
                            <div class="search-box">
                                <input type="text" placeholder="Tìm kiếm tour..." wire:model="searchQuery">
                                <i class="ti-search"></i>
                            </div>                            
                            <div class="view-options">
                                <button class="view-btn active" data-view="card">
                                    <i class="ti-layout-grid2"></i>
                                </button>
                                <button class="view-btn" data-view="list">
                                    <i class="ti-view-list"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    @if($bookings->isEmpty())
                        <div class="empty-history text-center">
                            <div class="empty-icon">
                                <i class="ti-calendar"></i>
                            </div>
                            <h4>Chưa có tour nào</h4>
                            <p>Bạn chưa đặt tour nào. Hãy khám phá các tour của chúng tôi.</p>
                            <a href="{{ route('frontend.tours.index') }}" class="btn btn-primary">
                                Khám phá tour ngay <i class="ti-arrow-right"></i>
                            </a>
                        </div>
                    @else
                        <div class="booking-grid">
                            @foreach($bookings as $booking)
                                <div class="booking-card">
                                    <div class="booking-image">
                                        <img src="{{ asset('frontend/img/tours/' . $booking->tour->image) }}" alt="{{ $booking->tour->name }}">
                                        <div class="booking-date">
                                            <span class="day">{{ $booking->booking_date->format('d') }}</span>
                                            <span class="month">{{ $booking->booking_date->format('M') }}</span>
                                        </div>
                                    </div>

                                    <div class="booking-content">
                                        <div class="booking-meta">
                                            <span class="booking-id">#{{ $booking->id }}</span>
                                            <span class="status-badge {{ $booking->status }}">
                                                @switch($booking->status)
                                                    @case('pending')
                                                        Chờ xác nhận
                                                        @break
                                                    @case('confirmed')
                                                        Đã xác nhận
                                                        @break
                                                    @case('completed')
                                                        Hoàn thành
                                                        @break
                                                    @case('cancelled')
                                                        Đã hủy
                                                        @break
                                                @endswitch
                                            </span>
                                        </div>

                                        <h4 class="tour-title">
                                            <a href="{{ route('frontend.tours.show', $booking->tour) }}">
                                                {{ $booking->tour->name }}
                                            </a>
                                        </h4>

                                        <div class="tour-details">
                                            <div class="detail-item">
                                                <i class="ti-location-pin"></i>
                                                <span>{{ $booking->tour->destination->name }}</span>
                                            </div>
                                            <div class="detail-item">
                                                <i class="ti-user"></i>
                                                <span>{{ $booking->adults + $booking->children }} người</span>
                                            </div>
                                            <div class="detail-item">
                                                <i class="ti-timer"></i>
                                                <span>{{ $booking->tour->duration }}</span>
                                            </div>
                                        </div>

                                        <div class="booking-footer flex-column align-items-start gap-2">
                                            <div class="d-flex justify-content-between w-100 align-items-center">
                                                <div class="price-info">
                                                    <span class="label">Đã thanh toán:</span>
                                                    <span class="price text-success fw-bold">{{ number_format($booking->amount_paid) }} VNĐ</span>
                                                    @if($booking->is_deposit)
                                                        <small class="d-block text-warning font-weight-bold">💰 Đặt cọc 30%</small>
                                                        @if($booking->remaining_amount > 0)
                                                            <small class="d-block text-danger">Còn nợ 70%: {{ number_format($booking->remaining_amount) }}đ</small>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="booking-actions d-flex flex-wrap gap-1">
                                                    @if($booking->status == 'pending')
                                                        <button class="btn btn-outline-danger btn-sm" wire:click="cancelBooking({{ $booking->id }})">
                                                            <i class="ti-close"></i> Hủy
                                                        </button>
                                                    @endif

                                                    <button class="btn btn-outline-primary btn-sm" onclick="viewDetails({{ $booking->id }}, '{{ $booking->status }}')">
                                                        <i class="ti-eye"></i> Chi tiết
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Financial Action Buttons (Pay Remaining 70% & Request Refund) -->
                                            <div class="w-100 mt-2 d-flex flex-wrap gap-2 border-top pt-2">
                                                @if($booking->is_deposit && $booking->remaining_amount > 0 && $booking->status != 'cancelled')
                                                    <form action="{{ route('frontend.bookings.pay-remaining', $booking) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-warning text-dark fw-bold" onclick="return confirm('Thanh toán số tiền nợ 70% còn lại ({{ number_format($booking->remaining_amount) }}đ)?')">
                                                            💰 Thanh toán 70% còn lại ({{ number_format($booking->remaining_amount) }}đ)
                                                        </button>
                                                    </form>
                                                @endif

                                                @if(($booking->payment_status === 'paid' || $booking->payment_status === 'deposit_paid') && $booking->status != 'cancelled' && $booking->refund_status === 'none')
                                                    <form action="{{ route('frontend.bookings.request-refund', $booking) }}" method="POST" class="d-inline" onsubmit="var reason = prompt('Nhập lý do bạn muốn hủy tour & hoàn tiền:'); if(!reason) return false; this.querySelector('input[name=refund_reason]').value = reason; return true;">
                                                        @csrf
                                                        <input type="hidden" name="refund_reason" value="">
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            🔄 Hủy tour & Yêu cầu Hoàn tiền
                                                        </button>
                                                    </form>
                                                @endif

                                                @if($booking->refund_status === 'requested')
                                                    <span class="badge bg-warning text-dark p-2 w-100 text-start">
                                                        ⏳ Đã gửi yêu cầu hoàn tiền (Dự kiến: {{ number_format($booking->refund_amount) }}đ)
                                                    </span>
                                                @elseif($booking->refund_status === 'refunded')
                                                    <span class="badge bg-success p-2 w-100 text-start">
                                                        ✅ Đã hoàn tiền thành công ({{ number_format($booking->refund_amount) }}đ)
                                                    </span>
                                                @endif

                                                <!-- Review Feature for Completed Bookings -->
                                                @if($booking->status === 'completed')
                                                    @if($booking->review)
                                                        <span class="badge bg-success p-2">
                                                            ✅ Đã đánh giá ({{ $booking->review->rating }} ⭐): "{{ Str::limit($booking->review->comment ?? $booking->review->content, 30) }}"
                                                        </span>
                                                    @else
                                                        <button class="btn btn-sm btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#reviewModal{{ $booking->id }}">
                                                            ⭐ Viết Đánh giá Tour
                                                        </button>

                                                        <!-- Review Submission Modal -->
                                                        <div class="modal fade" id="reviewModal{{ $booking->id }}" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <form action="{{ route('frontend.bookings.review.store', $booking) }}" method="POST">
                                                                        @csrf
                                                                        <div class="modal-header bg-success text-white">
                                                                            <h5 class="modal-title text-white"><i class="ti-star me-2"></i> Đánh giá chuyến đi #{{ $booking->id }}</h5>
                                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body text-start">
                                                                            <h6 class="fw-bold mb-1">{{ $booking->tour->name }}</h6>
                                                                            <p class="text-muted small mb-3">Ngày khởi hành: {{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}</p>

                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-bold">Chọn số sao trải nghiệm:</label>
                                                                                <select name="rating" class="form-select border-success fw-bold text-warning" required>
                                                                                    <option value="5" selected>⭐⭐⭐⭐⭐ (5/5 - Rất tuyệt vời!)</option>
                                                                                    <option value="4">⭐⭐⭐⭐ (4/5 - Hài lòng)</option>
                                                                                    <option value="3">⭐⭐⭐ (3/5 - Bình thường)</option>
                                                                                    <option value="2">⭐⭐ (2/5 - Tạm được)</option>
                                                                                    <option value="1">⭐ (1/5 - Không hài lòng)</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-bold">Viết cảm nhận / nhận xét của bạn:</label>
                                                                                <textarea name="comment" class="form-control" rows="4" placeholder="Chia sẻ trải nghiệm thực tế của bạn về hướng dẫn viên, dịch vụ, khách sạn..." required minlength="5"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer bg-light">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                                            <button type="submit" class="btn btn-success fw-bold">Gửi Đánh Giá ⭐</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="pagination-wrapper">
                            @if($bookings->hasPages())
                                <nav aria-label="Booking pagination">
                                    <ul class="pagination justify-content-center">
                                        <!-- Previous Page Link -->
                                        @if ($bookings->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="ti-angle-left"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $bookings->previousPageUrl() }}" rel="prev">
                                                    <i class="ti-angle-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        <!-- Pagination Elements -->
                                        @foreach ($bookings->getUrlRange(1, $bookings->lastPage()) as $page => $url)
                                            @if ($page == $bookings->currentPage())
                                                <li class="page-item active">
                                                    <span class="page-link">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        <!-- Next Page Link -->
                                        @if ($bookings->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $bookings->nextPageUrl() }}" rel="next">
                                                    <i class="ti-angle-right"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="ti-angle-right"></i>
                                                </span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@push('styles')
        <style>
            .booking-history {
                background: #f8f9fa;
                min-height: 100vh;
                padding: 60px 0;
            }

            /* Sidebar Styles */
            .history-sidebar {
                background: white;
                border-radius: 15px;
                box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
                padding: 25px;
                margin-bottom: 30px;
            }

            .sidebar-header {
                margin-bottom: 20px;
                padding-bottom: 15px;
                border-bottom: 1px solid #e9ecef;
            }

            .filter-section {
                margin-bottom: 25px;
            }

            .filter-section h5 {
                font-size: 1rem;
                margin-bottom: 15px;
                color: #333;
            }

            .filter-options {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .filter-option {
                display: flex;
                align-items: center;
                gap: 10px;
                cursor: pointer;
                margin: 0;
            }

            .filter-option input {
                display: none;
            }

            .checkmark {
                width: 20px;
                height: 20px;
                border: 2px solid #ddd;
                border-radius: 4px;
                position: relative;
            }

            .filter-option input:checked+.checkmark {
                background: #aa8453;
                border-color: #aa8453;
            }

            .filter-option input:checked+.checkmark::after {
                content: '';
                position: absolute;
                left: 6px;
                top: 2px;
                width: 5px;
                height: 10px;
                border: solid white;
                border-width: 0 2px 2px 0;
                transform: rotate(45deg);
            }

            .booking-stats {
                background: white;
                border-radius: 15px;
                box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
                padding: 25px;
            }

            .stat-item {
                padding: 15px 0;
                border-bottom: 1px solid #e9ecef;
            }

            .stat-item:last-child {
                border-bottom: none;
            }

            .stat-label {
                color: #6c757d;
                font-size: 0.9em;
                margin-bottom: 5px;
            }

            .stat-value {
                font-size: 1.5em;
                font-weight: 600;
                color: #333;
            }

            .stat-value.completed {
                color: #28a745;
            }

            .stat-value.upcoming {
                color: #aa8453;
            }

            /* Main Content Styles */
            .history-card {
                background: white;
                border-radius: 15px;
                box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
                padding: 30px;
            }

            .history-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 30px;
            }

            .search-box {
                position: relative;
                margin-right: 20px;
            }

            .search-box input {
                padding: 10px 40px 10px 15px;
                border: 1px solid #e9ecef;
                border-radius: 8px;
                width: 250px;
            }

            .search-box i {
                position: absolute;
                right: 15px;
                top: 50%;
                transform: translateY(-50%);
                color: #6c757d;
            }

            .view-options {
                display: flex;
                gap: 10px;
            }

            .view-btn {
                background: none;
                border: 1px solid #e9ecef;
                padding: 8px;
                border-radius: 8px;
                cursor: pointer;
                color: #6c757d;
            }

            .view-btn.active {
                background: #aa8453;
                color: white;
                border-color: #aa8453;
            }

            /* Booking Grid Styles */
            .booking-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 25px;
                margin-bottom: 30px;
            }

            .booking-card {
                background: white;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
                transition: transform 0.3s ease;
            }

            .booking-card:hover {
                transform: translateY(-5px);
            }

            .booking-image {
                position: relative;
                height: 200px;
            }

            .booking-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .booking-date {
                position: absolute;
                top: 15px;
                right: 15px;
                background: rgba(255, 255, 255, 0.9);
                padding: 10px;
                border-radius: 8px;
                text-align: center;
            }

            .booking-date .day {
                display: block;
                font-size: 1.5em;
                font-weight: 600;
                color: #aa8453;
            }

            .booking-date .month {
                display: block;
                font-size: 0.9em;
                color: #6c757d;
                text-transform: uppercase;
            }

            .booking-content {
                padding: 20px;
            }

            .booking-meta {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 15px;
            }

            .status-badge {
                padding: 6px 12px;
                border-radius: 20px;
                font-size: 0.85em;
                font-weight: 500;
            }

            .tour-title {
                margin-bottom: 15px;
            }

            .tour-title a {
                color: #333;
                text-decoration: none;
            }

            .tour-title a:hover {
                color: #aa8453;
            }

            .tour-details {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 15px;
                margin-bottom: 20px;
            }

            .detail-item {
                display: flex;
                align-items: center;
                gap: 8px;
                color: #6c757d;
                font-size: 0.9em;
            }

            .booking-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding-top: 15px;
                border-top: 1px solid #e9ecef;
            }

            .price-info .price {
                display: block;
                color: #aa8453;
                font-weight: 600;
                font-size: 1.1em;
            }

            .booking-actions {
                display: flex;
                gap: 10px;
            }

            /* Modal Styles */
            .modal-content {
                border-radius: 15px;
            }

            .modal-header {
                background: #f8f9fa;
                border-radius: 15px 15px 0 0;
            }

            /* Responsive Styles */
            @media (max-width: 992px) {
                .history-sidebar {
                    margin-bottom: 30px;
                }

                .booking-grid {
                    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                }
            }

            @media (max-width: 768px) {
                .history-header {
                    flex-direction: column;
                    gap: 20px;
                }

                .search-box {
                    width: 100%;
                    margin-right: 0;
                }

                .search-box input {
                    width: 100%;
                }

                .booking-footer {
                    flex-direction: column;
                    gap: 15px;
                    text-align: center;
                }

                .booking-actions {
                    justify-content: center;
                }
            }

            /* Pagination Styles */
            .pagination-wrapper {
                margin-top: 40px;
                margin-bottom: 20px;
            }

            .pagination {
                gap: 5px;
            }

            .page-item {
                margin: 0 2px;
            }

            .page-link {
                border: none;
                padding: 12px 18px;
                color: #666;
                background-color: #fff;
                border-radius: 8px !important;
                font-weight: 500;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
                transition: all 0.3s ease;
            }

            .page-link:hover {
                background-color: #f8f9fa;
                color: #aa8453;
                transform: translateY(-2px);
            }

            .page-item.active .page-link {
                background-color: #aa8453;
                color: white;
                border: none;
            }

            .page-item.disabled .page-link {
                background-color: #f8f9fa;
                color: #adb5bd;
                cursor: not-allowed;
            }

            /* Responsive pagination */
            @media (max-width: 576px) {
                .page-link {
                    padding: 8px 12px;
                    font-size: 0.9em;
                }

                .pagination {
                    gap: 3px;
                }
            }
        </style>
    @endpush

@push('scripts')
        <script>
            function viewDetails(bookingId, status) {
                let redirectUrl = '';

                switch (status) {
                    case 'pending':
                        redirectUrl = 'http://127.0.0.1:8000/bookings/' + bookingId + '/review';
                        break;
                    case 'confirmed':
                        redirectUrl = 'http://127.0.0.1:8000/bookings/' + bookingId + '/success';
                        break;
                    case 'cancelled':
                        redirectUrl = 'http://127.0.0.1:8000/bookings/' + bookingId + '/review';
                        break;
                    default:
                        alert('Trạng thái không hợp lệ');
                        return; // Dừng lại nếu trạng thái không hợp lệ
                }
                // Chuyển hướng người dùng đến URL tương ứng
                window.location.href = redirectUrl;
            }


            function cancelBooking(bookingId) {
                if (confirm('Bạn có chắc muốn hủy đặt tour này?')) {
                    // Implement cancellation logic
                }
            }

            // View toggle functionality
            document.querySelectorAll('.view-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    const view = this.dataset.view;
                    const bookingGrid = document.querySelector('.booking-grid');

                    if (view === 'list') {
                        bookingGrid.style.gridTemplateColumns = '1fr';
                    } else {
                        bookingGrid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(300px, 1fr))';
                    }
                });
            });
        </script>
    @endpush

