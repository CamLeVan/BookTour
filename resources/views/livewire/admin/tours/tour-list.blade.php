<div>
    <div class="content" style="padding-top: 2rem;">
        <div class="container-xxl">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold mb-0">Danh Sách Tour</h4>
                    <p class="text-muted mb-0">Quản lý các tour của bạn</p>
                </div>
                <div class="d-flex gap-2">
                    <div class="dropdown">
                        <button class="btn btn-secondary" wire:click="export('xlsx')">
                            <i class="mdi mdi-export me-1"></i> Xuất Excel
                        </button>
                    </div>
                    <a href="{{ route('admin.tours.create') }}" class="btn btn-primary">
                        <i class="mdi mdi-plus me-1"></i> Thêm Tour
                    </a>
                </div>
            </div>

            <!-- Search Filters -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" wire:model.live="search"
                                placeholder="Tìm kiếm theo tên...">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" wire:model.live="destination_id">
                                <option value="">Tất cả điểm đến</option>
                                @foreach ($destinations as $destination)
                                    <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" wire:model.live="status">
                                <option value="">Tất cả trạng thái</option>
                                <option value="active">Hoạt động</option>
                                <option value="inactive">Tạm dừng</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" wire:model.live="dateRange"
                                placeholder="Chọn khoảng ngày" id="daterangepicker">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tour List Table -->
            <div class="card">
                <div class="card-body">
                    @if ($tours->isEmpty())
                        <div class="text-center py-5">
                            <img src="{{ asset('assets/images/empty.svg') }}" alt="No tours" class="mb-3"
                                width="120">
                            <h5>Chưa có tour nào</h5>
                            <p class="text-muted">Bắt đầu bằng cách thêm tour mới</p>
                            <a href="{{ route('admin.tours.create') }}" class="btn btn-primary">
                                <i class="mdi mdi-plus me-1"></i> Thêm Tour
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="min-width: 250px;">Tên Tour</th>
                                        <th style="min-width: 120px;">Điểm Đến</th>
                                        <th style="min-width: 120px;">Giá</th>
                                        <th style="min-width: 100px;">Thời Gian</th>
                                        <th style="min-width: 100px;">Số Người</th>
                                        <th style="min-width: 100px;">Trạng Thái</th>
                                        <th style="min-width: 100px;">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tours as $tour)
                                        <tr>
                                            <td>
                                                <div>
                                                    <h6 class="mb-1">{{ $tour->name }}</h6>
                                                    <small class="text-muted">ID: #{{ $tour->id }}</small>
                                                    {{-- <small class="text-muted">Mã tour: TOUR{{ str_pad($tour->id, 4, '0', STR_PAD_LEFT) }}</small> --}}
                                                </div>
                                            </td>
                                            <td>{{ $tour->destination->name }}</td>
                                            <td>{{ number_format($tour->price, 0, ',', '.') }} VND</td>
                                            <td>{{ $tour->duration }} ngày</td>
                                            <td>{{ $tour->max_people }} người</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $tour->status === 'active' ? 'success' : 'danger' }}">
                                                    {{ $tour->status === 'active' ? 'Hoạt động' : 'Tạm dừng' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('admin.tours.edit', $tour->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        wire:click="confirmDelete({{ $tour->id }})"
                                                        data-bs-toggle="tooltip"
                                                        title="{{ $tour->status === 'active' ? 'Tour đang hoạt động không thể xóa' : 'Xóa tour' }}"
                                                        {{ $tour->status === 'active' ? 'disabled' : '' }}>
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </div>
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

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(function() {
            $('#daterangepicker').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('#daterangepicker').on('apply.daterangepicker', function(ev, picker) {
                @this.set('dateRange', picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate
                    .format('YYYY-MM-DD'));
            });

            $('#daterangepicker').on('cancel.daterangepicker', function(ev, picker) {
                @this.set('dateRange', '');
            });
        });
    </script>
@endpush
