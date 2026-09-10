<h6>Information</h6>
<p class="mb-30">{{ $tour->description }}</p>

<ul class="list-unstyled page-list mb-30">
    <li>
        <div class="page-list-icon"> <span class="ti-check"></span> </div>
        <div class="page-list-text">
            <p>{{ $tour->duration }} Days {{ $tour->duration - 1 }} Nights, 
               Group: {{ $tour->min_people }} - {{ $tour->max_people }} People, 
               {{ $tour->destination->name }}</p>
        </div>
    </li>
</ul>

<div class="tour-page time-table">
    <span>Departure</span>
    <p>{{ $tour->departure_point }}</p>
</div>

<div class="tour-page time-table">
    <span>Departure Time</span>
    <p>{{ $tour->departure_time }}</p>
</div>

<!-- Price Includes -->
<div class="tour-page time-table-price">
    <span>Price Includes</span>
    <ul class="tour-page time-table-price-include">
        @foreach($tour->includes as $include)
        <li><i class="ti-check"></i> {{ $include }}</li>
        @endforeach
    </ul>
</div>

<!-- Price Excludes -->
<div class="tour-page time-table-price">
    <span>Price Excludes</span>
    <ul class="tour-page time-table-price-exclude">
        @foreach($tour->excludes as $exclude)
        <li><i class="ti-close"></i> {{ $exclude }}</li>
        @endforeach
    </ul>
</div> 