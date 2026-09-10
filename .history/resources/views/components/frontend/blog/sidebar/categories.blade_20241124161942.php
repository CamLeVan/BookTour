<div class="blog-sidebar-widget">
    <div class="blog-sidebar-widget-title">
        <h6>Categories</h6>
    </div>
    <ul class="blog-categories-list">
        @foreach($categories as $category)
            <li class="blog-category-item">
                <a href="{{ route('frontend.blog.category', $category->slug) }}">
                    <div class="category-info">
                        <i class="ti-angle-right"></i>
                        <span class="category-name">{{ $category->name }}</span>
                    </div>
                    <span class="post-count">({{ $category->posts_count }})</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>

<style>
    .blog-sidebar-widget {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .blog-sidebar-widget:hover {
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    .blog-sidebar-widget-title {
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #eef0f3;
        position: relative;
    }

    .blog-sidebar-widget-title:after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 50px;
        height: 2px;
        background: #2095AE;
    }

    .blog-sidebar-widget-title h6 {
        font-size: 18px;
        font-weight: 600;
        color: #0f2454;
        margin: 0;
    }

    .blog-categories-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .blog-category-item {
        margin-bottom: 12px;
        transition: all 0.3s ease;
    }

    .blog-category-item:last-child {
        margin-bottom: 0;
    }

    .blog-category-item a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #666;
        text-decoration: none;
        padding: 8px 12px;
        border-radius: 6px;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .blog-category-item a:hover {
        color: #2095AE;
        background: #f0f8f9;
        transform: translateX(5px);
    }

    .category-info {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .blog-category-item a i {
        font-size: 12px;
        color: #2095AE;
        transition: all 0.3s ease;
    }

    .blog-category-item a:hover i {
        transform: rotate(90deg);
    }

    .category-name {
        font-weight: 500;
    }

    .post-count {
        color: #9aa1b9;
        font-size: 14px;
        background: #fff;
        padding: 2px 8px;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .blog-category-item a:hover .post-count {
        background: #2095AE;
        color: #fff;
    }
</style> 