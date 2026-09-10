<div class="booking-wrapper">
    <div class="container">
        <div class="tour-inner clearfix form-inline justify-content-center">
            <div class="form1 clearfix">
                <div class="col1 c1">
                    <div class="input2_wrapper">
                        <label>Bạn muốn đi đâu?</label>
                        <div class="input2_inner">
                            <input type="text" 
                                wire:model.live="searchTerm" 
                                class="form-control input" 
                                placeholder="Nhập tên địa điểm...">
                        </div>
                    </div>
                </div>

                <div class="col1 c2">
                    <div class="select1_wrapper">
                        <label>Điểm đến</label>
                        <div class="select1_inner">
                            <select wire:model.live="destination" class="select2 select" style="width: 100%">
                                <option value="">Chọn điểm đến</option>
                                @foreach($destinations as $dest)
                                    <option value="{{ $dest->id }}">{{ $dest->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col1 c4">
                    <div class="select1_wrapper">
                        <label>Thời gian</label>
                        <div class="select1_inner">
                            <select wire:model.live="duration" class="select2 select" style="width: 100%">
                                <option value="">Chọn thời gian</option>
                                <option value="1-1">1 Ngày</option>
                                <option value="2-4">2-4 Ngày</option>
                                <option value="5-7">5-7 Ngày</option>
                                <option value="7+">Trên 7 Ngày</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col1 c5">
                    <button wire:click="search" class="btn-form1-submit">
                        <i class="ti-search"></i> Tìm Tour
                    </button>
                </div>
            </div>
        </div>

        <!-- Results Section -->
        @if($tours->count() > 0)
            <div class="row mt-4">
                @foreach($tours as $tour)
                    <div class="col-md-4 mb-4">
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
                @endforeach
            </div>
            
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    {{ $tours->links() }}
                </div>
            </div>
        @else
            <div class="row mt-4">
                <div class="col-md-12 text-center">
                    <p>Không tìm thấy tour phù hợp.</p>
                </div>
            </div>
        @endif
    </div>
</div> 