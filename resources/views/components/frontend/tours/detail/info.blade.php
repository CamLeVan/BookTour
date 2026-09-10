<div class="section-subtitle">HC Travel</div>
<div class="section-title mb-0">{{ $tour->name }}</div>

<div class="rating mb-30">
    @for($i = 1; $i <= 5; $i++)
        <i class="star {{ $i <= $tour->rating ? 'active' : '' }}"></i>
    @endfor
    <div class="reviews-count color-2">({{ $tour->reviews_count }} Reviews)</div>
</div>

<div class="tour-page head-icon">
    <p><i class="ti-time"></i> {{ $tour->duration }} Days {{ $tour->duration - 1 }} Nights</p>
    <p><i class="ti-user"></i> Group: {{ $tour->min_people }} - {{ $tour->max_people }} People</p>
    <p><i class="ti-location-pin"></i> {{ $tour->destination->name }}</p>
    <p><i class="ti-face-smile"></i> {{ number_format($tour->rating, 1) }} {{ $tour->rating_text }}</p>
</div> 