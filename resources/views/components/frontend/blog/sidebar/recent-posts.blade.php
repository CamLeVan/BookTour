<div class="blog-sidebar-widget">
    <div class="blog-sidebar-widget-title">
        <h6>Recent Posts</h6>
    </div>
    <ul class="blog-recent-posts">
        @foreach($recentPosts as $post)
            <li class="blog-recent-post-item">
                <div class="post-thumb">
                    <a href="{{ route('frontend.blog.show', $post->slug) }}" class="thumb-link">
                        <img src="{{ $post->image ? asset('frontend/' . $post->image) : asset('img/blog/1.jpg') }}" alt="">
                    </a>
                </div>
                <div class="post-info">
                    <a href="{{ route('frontend.blog.show', $post->slug) }}" class="post-title">{{ $post->title }}</a>
                    <div class="post-meta">
                        <i class="ti-calendar"></i>
                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
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
        margin-bottom: 25px;
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

    .blog-recent-posts {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .blog-recent-post-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px dashed #eef0f3;
        transition: all 0.3s ease;
    }

    .blog-recent-post-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .blog-recent-post-item:hover {
        transform: translateX(5px);
    }

    .post-thumb {
        width: 90px;
        height: 70px;
        margin-right: 15px;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
    }

    .thumb-link {
        display: block;
        width: 100%;
        height: 100%;
        position: relative;
    }

    .thumb-link:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(32, 149, 174, 0.2);
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 1;
    }

    .blog-recent-post-item:hover .thumb-link:before {
        opacity: 1;
    }

    .post-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.3s ease;
    }

    .blog-recent-post-item:hover .post-thumb img {
        transform: scale(1.1);
    }

    .post-info {
        flex: 1;
    }

    .post-title {
        display: block;
        color: #0f2454;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        line-height: 1.4;
        margin-bottom: 8px;
        transition: color 0.3s ease;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .post-title:hover {
        color: #2095AE;
    }

    .post-meta {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 13px;
        color: #9aa1b9;
    }

    .post-meta i {
        font-size: 12px;
        color: #2095AE;
    }

    .post-meta span {
        line-height: 1;
    }
</style> 