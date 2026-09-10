<div>
    <div class="content">
        <div class="container-xxl">
            <!-- Header -->
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Danh sách Tour</h4>
                </div>
                <div class="col-md-6 d-flex justify-content-end gap-2">
                    <!-- Search -->
                    <div class="w-50">
                        <input type="text" wire:model.debounce.300ms="search" class="form-control"
                            placeholder="Tìm kiếm theo tên tour, điểm đến...">
                    </div>

                    <!-- Filter by Status -->
                    <select wire:model="statusFilter" class="form-select w-auto">
                        <option value="">Tất cả trạng thái</option>
                        <option value="active">Đang hoạt động</option>
                        <option value="inactive">Tạm ngưng</option>
                    </select>
                </div>
            </div>

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Danh sách Tour</h5>
                        </div>

                        <div class="card-body">
                            @if ($tours->isEmpty())
                                <div class="text-center py-4">
                                    <p>Chưa có tour nào được tạo</p>
                                </div>
                            @else
                                <table id="datatable-buttons"
                                    class="table table-striped table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>Tên Tour</th>
                                            <th>Người tạo</th>
                                            <th>Điểm đến</th>
                                            <th>Giá</th>
                                            <th>Thời gian</th>
                                            <th>Số người</th>
                                            <th>Hình ảnh</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tours as $tour)
                                            <tr>
                                                <td>{{ $tour->name }}</td>
                                                <td>
                                                    <span class="badge bg-info">
                                                        {{ $tour->admin->name }}
                                                    </span>
                                                </td>
                                                <td>{{ $tour->destination->name }}</td>
                                                <td>{{ number_format($tour->price, 0, ',', '.') }} VND</td>
                                                <td>{{ $tour->duration }} ngày</td>
                                                <td>{{ $tour->max_people }}</td>
                                                <td>
                                                    @if ($tour->image)
                                                        <img src="{{ asset($tour->image) }}" 
                                                             alt="{{ $tour->name }}" 
                                                             class="tour-thumbnail"
                                                             style="width: 80px; 
                                                                    height: 60px; 
                                                                    object-fit: cover; 
                                                                    border-radius: 8px;
                                                                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                                                    transition: transform 0.2s ease;
                                                                    cursor: pointer;"
                                                             onclick="window.open(this.src, '_blank')"
                                                             title="Click để xem ảnh gốc" />
                                                    @else
                                                        <div class="no-image-placeholder"
                                                             style="width: 80px;
                                                                    height: 60px;
                                                                    background-color: #f8f9fa;
                                                                    border-radius: 8px;
                                                                    display: flex;
                                                                    align-items: center;
                                                                    justify-content: center;
                                                                    color: #6c757d;
                                                                    font-size: 12px;
                                                                    border: 1px dashed #dee2e6;">
                                                            No image
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $tour->status === 'active' ? 'success' : 'danger' }}">
                                                        {{ $tour->status === 'active' ? 'Đang hoạt động' : 'Tạm ngưng' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($tour->created_at)
                                                        {{ $tour->created_at->format('d/m/Y H:i') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                                        <button type="button"
                                                            wire:click="viewTour({{ $tour->id }})"
                                                            class="btn btn-info btn-sm" title="Xem chi tiết">
                                                            <i class="mdi mdi-eye"></i>
                                                        </button>
                                                        <button type="button"
                                                            wire:click="deleteTour({{ $tour->id }})"
                                                            wire:confirm="Bạn có chắc chắn muốn xóa tour này?"
                                                            class="btn btn-danger btn-sm" title="Xóa tour">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="mt-3">
                                    {{ $tours->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
