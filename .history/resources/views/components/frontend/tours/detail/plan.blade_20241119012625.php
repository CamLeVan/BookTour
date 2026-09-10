<h6>Tour Plan</h6>
<ul class="accordion-box clearfix">
    @foreach($tour->schedules as $day => $schedule)
    <li class="accordion block">
        <div class="acc-btn">Day {{ $day + 1 }}: {{ $schedule->title }}</div>
        <div class="acc-content">
            <div class="content">
                <div class="text">
                    {{ $schedule->description }}
                </div>
            </div>
        </div>
    </li>
    @endforeach
</ul> 