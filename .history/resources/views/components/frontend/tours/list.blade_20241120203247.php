@php
    $destinations = \App\Models\Destination::all();
@endphp

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
                    <form action="{{ route('frontend.tours.index') }}" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="destination" class="form-select">
                                    <option value="">All Destinations</option>
                                    @foreach($destinations as $destination)
                                        <option value="{{ $destination->id }}" 
                                            {{ request('destination') == $destination->id ? 'selected' : '' }}>
                                            {{ $destination->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="duration" class="form-select">
                                    <option value="">Duration</option>
                                    <option value="1-3" {{ request('duration') == '1-3' ? 'selected' : '' }}>1-3 Days</option>
                                    <option value="4-7" {{ request('duration') == '4-7' ? 'selected' : '' }}>4-7 Days</option>
                                    <option value="8+" {{ request('duration') == '8+' ? 'selected' : '' }}>8+ Days</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="price" class="form-select">
                                    <option value="">Price Range</option>
                                    <option value="0-1000000" {{ request('price') == '0-1000000' ? 'selected' : '' }}>Under 1M</option>
                                    <option value="1000000-3000000" {{ request('price') == '1000000-3000000' ? 'selected' : '' }}>1M - 3M</option>
                                    <option value="3000000+" {{ request('price') == '3000000+' ? 'selected' : '' }}>Over 3M</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="butn-dark btn-block"><span>Filter</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tours Grid -->
        <div class="row">
            @forelse($tours as $tour)
            <div class="col-md-4 mb-4">
                <div class="item">
                    <div class="position-re o-hidden">
                        <img src="{{ asset($tour->thumbnail) }}" alt="{{ $tour->name }}">
                        @if($tour->sale_price)
                        <div class="ribbon">
                            <span>Sale</span>
                        </div>
                        @endif
                    </div>
                    
                    <span class="category">
                        @if($tour->sale_price)
                            <del class="text-muted">{{ number_format($tour->price) }}đ</del>
                            <a href="#">{{ number_format($tour->sale_price) }}đ</a>
                        @else
                            <a href="#">{{ number_format($tour->price) }}đ</a>
                        @endif
                    </span>

                    <div class="con">
                        <div class="rating">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="star {{ $i <= $tour->rating ? 'active' : '' }}"></i>
                            @endfor
                            <div class="reviews-count">({{ $tour->reviews_count }} Reviews)</div>
                        </div>

                        <h5>
                            <a href="{{ route('frontend.tours.show', $tour->id) }}">
                                {{ $tour->name }}
                            </a>
                        </h5>

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
                    No tours found matching your criteria.
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