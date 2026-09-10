<div class="blog-sidebar-widget">
    <div class="blog-sidebar-widget-title">
        <h6>Tags</h6>
        <span class="widget-title-decoration"></span>
    </div>
    <ul class="blog-tags-list">
        @foreach($tags as $tag)
            <li class="blog-tag-item">
                <a href="{{ route('frontend.blog.tag', $tag->slug) }}" class="blog-tag-link">
                    <span class="tag-name">{{ $tag->name }}</span>
                    <span class="tag-count">{{ $tag->posts_count }}</span>
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

    .blog-tags-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .blog-tag-item {
        margin: 0;
        position: relative;
    }

    .blog-tag-link {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: #f8f9fa;
        border-radius: 30px;
        color: #666;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        overflow: hidden;
    }

    .blog-tag-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, #2095AE, #1a7a8f);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
    }

    .tag-name, .tag-count {
        position: relative;
        z-index: 2;
        transition: all 0.3s ease;
    }

    .tag-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 20px;
        height: 20px;
        padding: 0 6px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        font-size: 12px;
        color: #2095AE;
        font-weight: 600;
    }

    /* Hover Effects */
    .blog-tag-link:hover {
        transform: translateY(-2px);
        color: #fff;
    }

    .blog-tag-link:hover::before {
        opacity: 1;
    }

    .blog-tag-link:hover .tag-count {
        background: #fff;
        color: #2095AE;
    }

    /* Active State */
    .blog-tag-link:active {
        transform: translateY(0);
    }

    /* Hover Glow Effect */
    .blog-tag-link::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at center, rgba(255, 255, 255, 0.2) 0%, transparent 60%);
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
        z-index: 1;
    }

    .blog-tag-link:hover::after {
        opacity: 1;
    }

    /* Animation for new tags */
    @keyframes tagPop {
        0% { transform: scale(0.8); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }

    .blog-tag-item {
        animation: tagPop 0.3s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
    }

    /* Responsive */
    @media (max-width: 767px) {
        .blog-sidebar-widget {
            padding: 20px;
        }

        .blog-tag-link {
            padding: 6px 12px;
            font-size: 13px;
        }

        .tag-count {
            min-width: 18px;
            height: 18px;
            font-size: 11px;
        }
    }
</style> 