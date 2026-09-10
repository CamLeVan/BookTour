<div class="widget">
    <div class="widget-title">
        <h6>Archives</h6>
    </div>
    <ul>
        @foreach($archives as $archive)
            <li>
                <a href="{{ route('frontend.blog.archive', ['year' => $archive->year, 'month' => $archive->month]) }}">
                    <i class="ti-angle-right"></i>
                    {{ \Carbon\Carbon::createFromDate($archive->year, $archive->month, 1)->format('F Y') }}
                    <span>({{ $archive->post_count }})</span>
                </a>
            </li>
        @endforeach
    </ul>
</div> 