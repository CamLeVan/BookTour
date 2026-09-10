<div class="blog-sidebar-widget">
    <div class="blog-sidebar-widget-title">
        <h6>Archives</h6>
        <span class="widget-title-decoration"></span>
    </div>
    <ul class="blog-sidebar-archives">
        @foreach($archives as $archive)
            <li class="archive-item">
                <a href="{{ route('frontend.blog.archive', ['year' => $archive->year, 'month' => $archive->month]) }}">
                    <div class="archive-info">
                        <i class="ti-calendar"></i>
                        <span class="archive-date">{{ \Carbon\Carbon::createFromDate($archive->year, $archive->month, 1)->format('F Y') }}</span>
                    </div>
                    <div class="post-count">
                        <span>{{ $archive->post_count }}</span>
                        <i class="ti-angle-right"></i>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
</div>

<style>
    .blog-sidebar-widget {
        background: #fff;
        padding: 25px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .blog-sidebar-widget:hover {
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    .blog-sidebar-widget-title {
        position: relative;
        margin-bottom: 25px;
        padding-bottom: 15px;
    }

    .blog-sidebar-widget-title h6 {
        font-size: 20px;
        font-weight: 600;
        color: #0f2454;
        margin: 0;
        position: relative;
        display: inline-block;
    }

    .widget-title-decoration {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(to right, #2095AE 0%, #2095AE 30%, #eef0f3 30%, #eef0f3 100%);
    }

    .blog-sidebar-archives {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .archive-item {
        margin-bottom: 12px;
        transform: translateX(0);
        transition: transform 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .archive-item:last-child {
        margin-bottom: 0;
    }

    .archive-item a {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 16px;
        background: #f8f9fa;
        border-radius: 12px;
        color: #666;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .archive-item:hover {
        transform: translateX(5px);
    }

    .archive-item a:hover {
        background: #eef7f8;
        color: #2095AE;
    }

    .archive-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .archive-info i {
        font-size: 14px;
        color: #2095AE;
        transition: all 0.3s ease;
    }

    .archive-date {
        font-weight: 500;
        font-size: 15px;
        letter-spacing: 0.3px;
    }

    .post-count {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #fff;
        padding: 6px 12px;
        border-radius: 20px;
        transition: all 0.3s ease;
    }

    .post-count span {
        color: #9aa1b9;
        font-size: 14px;
        font-weight: 500;
    }

    .post-count i {
        font-size: 12px;
        color: #2095AE;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        opacity: 0;
        transform: translateX(-5px);
    }

    .archive-item a:hover .post-count {
        background: #2095AE;
        transform: scale(1.05);
    }

    .archive-item a:hover .post-count span {
        color: #fff;
    }

    .archive-item a:hover .post-count i {
        opacity: 1;
        transform: translateX(0);
        color: #fff;
    }

    .archive-item a:hover .archive-info i {
        transform: rotate(15deg);
    }

    /* Hover effect for each item */
    .archive-item a::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at center, rgba(32, 149, 174, 0.08) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.4s ease;
        border-radius: 12px;
        pointer-events: none;
        z-index: 1;
    }

    .archive-item a:hover::before {
        opacity: 1;
    }

    .archive-info, .post-count {
        position: relative;
        z-index: 2;
    }

    @media (max-width: 767px) {
        .blog-sidebar-widget {
            padding: 20px;
        }
        
        .archive-item a {
            padding: 10px 12px;
        }
        
        .archive-date {
            font-size: 14px;
        }
        
        .post-count {
            padding: 4px 10px;
        }
    }
</style> 