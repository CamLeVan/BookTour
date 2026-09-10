@props(['tours', 'destinations'])

<div class="tours3 section-padding">
    <div class="container">
        <div class="row">
            <!-- Tour list -->
            <div class="col-md-8">
                <div class="row">
                    @forelse($tours as $tour)
                    <div class="col-md-6">
                        <div class="square-flip">
                            <div class="square bg-img" data-background="{{ $tour->getFirstMediaUrl('images') }}">
                                <span class="category">
                                    <a href="#">{{ $tour->destination->name }}</a>
                                </span>
                                <div class="square-container d-flex align-items-end justify-content-end">
                                    <div class="box-title">
                                        <h4>{{ $tour->name }}</h4>
                                        <h6>{{ number_format($tour->price) }}đ / người</h6>
                                    </div>
                                </div>
                                <div class="flip-overlay"></div>
                            </div>
                            <div class="square2">
                                <div class="square-container2">
                                    <h4>{{ $tour->name }}</h4>
                                    <h6>{{ number_format($tour->price) }}đ / người</h6>
                                    <p>{{ Str::limit($tour->description, 100) }}</p>
                                    <div class="row tour-list mb-30">
                                        <div class="col col-md-6">
                                            <ul>
                                                <li><i class="ti-time"></i> {{ $tour->duration }} Ngày</li>
                                                <li><i class="ti-user"></i> {{ $tour->group_size }}+</li>
                                            </ul>
                                        </div>
                                        <div class="col col-md-6">
                                            <ul>
                                                <li><i class="ti-location-pin"></i> {{ $tour->destination->name }}</li>
                                                <li><i class="ti-face-smile"></i> {{ number_format($tour->rating, 1) }} Tuyệt vời</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="btn-line">
                                        <a href="{{ route('frontend.tours.show', $tour) }}">Chi tiết tour</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            Không tìm thấy tour nào phù hợp
                        </div>
                    </div>
                    @endforelse
                </div>
                
                {{ $tours->links('vendor.pagination.custom') }}
            </div>

            <!-- Tour search -->
            <div class="col-md-4">
                <div class="sidebar">
                    <div class="right-sidebar">
                        <div class="right-sidebar item">
                            <h3><span class="right-sidebar">Tìm Tour</span></h3>
                            <form method="GET" action="{{ route('frontend.tours.index') }}" class="right-sidebar item-form">
                                <div class="row">
                                    <div class="col-md-12 form-group select1_inner">
                                        <select name="destination" class="select2 select">
                                            <option value="">Điểm đến</option>
                                            @foreach($destinations as $destination)
                                                <option value="{{ $destination->id }}" 
                                                    {{ request('destination') == $destination->id ? 'selected' : '' }}>
                                                    {{ $destination->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group input1_inner">
                                        <input type="text" name="start_date" 
                                               class="form-control input datepicker" 
                                               placeholder="Ngày bắt đầu"
                                               value="{{ request('start_date') }}">
                                    </div>
                                    <div class="col-md-12 form-group input1_inner">
                                        <input type="text" name="end_date" 
                                               class="form-control input datepicker" 
                                               placeholder="Ngày kết thúc"
                                               value="{{ request('end_date') }}">
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="butn-dark">
                                            <span>Tìm Kiếm</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 