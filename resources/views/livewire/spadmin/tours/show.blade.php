<div class="content">
    <div class="container-xxl">
        <!-- Header -->
        <div class="py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fs-18 fw-semibold mb-0">Chi tiết Tour</h4>
                <a href="{{ route('spadmin.tours.tour-list-sp') }}" class="btn btn-secondary">
                    <i class="mdi mdi-arrow-left me-1"></i> Quay lại
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Ảnh tour -->
                            <div class="col-md-4 mb-3">
                                @if ($tour->image)
                                    <img src="{{ Storage::url($tour->image) }}" alt="{{ $tour->name }}"
                                        class="img-fluid rounded">
                                @else
                                    <div class="bg-light rounded p-3 text-center">
                                        <i class="mdi mdi-image-off fs-24"></i>
                                        <p class="mb-0">Không có hình ảnh</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Thông tin tour -->
                            <div class="col-md-8">
                                <h4 class="card-title">{{ $tour->name }}</h4>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <p class="mb-2">
                                            <strong>Điểm đến:</strong>
                                            {{ $tour->destination->name }}
                                        </p>
                                        <p class="mb-2">
                                            <strong>Giá:</strong>
                                            {{ number_format($tour->price, 0, ',', '.') }} VND
                                        </p>
                                        <p class="mb-2">
                                            <strong>Thời gian:</strong>
                                            {{ $tour->duration }} ngày
                                        </p>
                                        <p class="mb-2">
                                            <strong>Số người tối đa:</strong>
                                            {{ $tour->max_people }} người
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-2">
                                            <strong>Người tạo:</strong>
                                            <span class="badge bg-info">{{ $tour->admin->name }}</span>
                                        </p>
                                        <p class="mb-2">
                                            <strong>Trạng thái:</strong>
                                            <span
                                                class="badge bg-{{ $tour->status === 'active' ? 'success' : 'danger' }}">
                                                {{ $tour->status === 'active' ? 'Đang hoạt động' : 'Tạm ngưng' }}
                                            </span>
                                        </p>
                                        <p class="mb-2">
                                            <strong>Ngày tạo:</strong>
                                            {{ $tour->created_at?->format('d/m/Y H:i') ?? 'N/A' }}
                                        </p>
                                        <p class="mb-2">
                                            <strong>Cập nhật lần cuối:</strong>
                                            {{ $tour->updated_at?->format('d/m/Y H:i') ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Mô tả tour -->
                                <div class="mt-4">
                                    <h5>Mô tả:</h5>
                                    <div class="border rounded p-3 bg-light">
                                        {!! nl2br(e($tour->description)) !!}
                                    </div>
                                </div>

                                <!-- Lịch trình -->
                                <div class="mt-4">
                                    <h5>Lịch trình:</h5>
                                    <div class="border rounded p-3 bg-light">
                                        {!! nl2br(e($tour->schedule)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
