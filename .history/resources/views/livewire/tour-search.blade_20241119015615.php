<section class="tours1 section-padding bg-lightnav" data-scroll-index="1">
    <div class="container">
        <!-- Title -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-subtitle"><span>Choose your place</span></div>
                <div class="section-title">Popular <span>Tours</span></div>
            </div>
        </div>

        <!-- Filter -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="tour-filter">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="select1_wrapper">
                                <label>Bạn muốn đi đâu?</label>
                                <div class="select1_inner">
                                    <input type="text" 
                                        wire:model.live="searchTerm" 
                                        class="form-control" 
                                        placeholder="Nhập tên địa điểm...">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="select1_wrapper">
                                <label>Điểm đến</label>
                                <div class="select1_inner">
                                    <select wire:model.live="destination" class="form-select">
                                        <option value="">Chọn điểm đến</option>
                                        @foreach($destinations as $dest)
                                            <option value="{{ $dest->id }}">{{ $dest->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="select1_wrapper">
                                <label>Thời gian</label>
                                <div class="select1_inner">
                                    <select wire:model.live="duration" class="form-select">
                                        <option value="">Chọn thời gian</option>
                                        <option value="1-1">1 Ngày</option>
                                        <option value="2-4">2-4 Ngày</option>
                                        <option value="5-7">5-7 Ngày</option>
                                        <option value="7+">Trên 7 Ngày</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <button wire:click="search" class="butn-dark btn-block">
                                <span><i class="ti-search"></i> Tìm Tour</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tours Grid -->
        <div class="row">
            @forelse($tours as $tour)
                <div class="col-md-4 mb-4">
                    <!-- Tour item structure giống như cũ -->
                    <div class="item">
                        <div class="position-re o-hidden">
                            <img src="{{ asset($tour->thumbnail) }}" alt="{{ $tour->name }}">
                        </div>
                        <span class="category"><a href="#">{{ number_format($tour->price) }}đ</a></span>
                        <div class="con">
                            <h5><a href="{{ route('frontend.tours.show', $tour->id) }}">{{ $tour->name }}</a></h5>
                            <div class="line"></div>
                            <div class="row facilities">
                                <div class="col col-md-12">
                                    <ul>
                                        <li><i class="ti-time"></i> {{ $tour->duration }} Days</li>
                                        <li><i class="ti-user"></i> {{ $tour->min_people }}+</li>
                                        <li><i class="ti-location-pin"></i> {{ $tour->destination->name }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="alert alert-info text-center">
                        Không tìm thấy tour phù hợp.
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                {{ $tours->links() }}
            </div>
        </div>
    </div>
</section> 