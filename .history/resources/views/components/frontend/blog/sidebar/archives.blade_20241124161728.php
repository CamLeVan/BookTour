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

<style>
    .widget {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }

    .widget-title {
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #eef0f3;
    }

    .widget-title h6 {
        font-size: 18px;
        font-weight: 600;
        color: #0f2454;
        margin: 0;
    }

    .widget ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .widget ul li {
        margin-bottom: 12px;
    }

    .widget ul li:last-child {
        margin-bottom: 0;
    }

    .widget ul li a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #666;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .widget ul li a:hover {
        color: #2095AE;
    }

    .widget ul li a i {
        margin-right: 8px;
        font-size: 12px;
        color: #2095AE;
    }

    .widget ul li a span {
        color: #9aa1b9;
        font-size: 14px;
    }
</style> 