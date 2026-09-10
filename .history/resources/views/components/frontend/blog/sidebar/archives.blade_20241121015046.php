<div class="col-md-12">
    <div class="widget">
        <div class="widget-title">
            <h6>Archives</h6>
        </div>
        <ul>
            @foreach($archives as $archive)
            <li>
                <a href="{{ route('frontend.blog.archive', [$archive->year, $archive->month]) }}">
                    {{ Carbon\Carbon::createFromDate($archive->year, $archive->month, 1)->format('F Y') }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div> 