@props(['tours'])

<section class="tours1 section-padding bg-lightnav" data-scroll-index="1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-subtitle"><span>Choose your place</span></div>
                <div class="section-title">Popular <span>Tours</span></div>
            </div>
        </div>
        <div class="row">
            @foreach($tours as $tour)
            <div class="col-md-4">
                <div class="item">
                    <div class="position-re o-hidden"> 
                        <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->name }}"> 
                    </div>
                    <div class="con">
                        <div class="category">
                            <span class="category1"><a href="#">{{ $tour->duration }} Days</a></span>
                            <span class="category2"><a href="#">{{ $tour->price }}$</a></span>
                        </div>
                        <h5><a href="{{ route('frontend.tours.show', $tour) }}">{{ $tour->name }}</a></h5>
                        <div class="line"></div>
                        <div class="row facilities">
                            <div class="col col-md-12">
                                <ul>
                                    <li><i class="ti-time"></i> {{ $tour->duration }} Days</li>
                                    <li><i class="ti-user"></i> {{ $tour->max_people }}+</li>
                                    <li><i class="ti-location-pin"></i> {{ $tour->location }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <a href="{{ route('frontend.tours.index') }}" class="butn-dark2"><span>View All Tours</span></a>
                </div>
            </div>
        </div>
    </div>
</section>