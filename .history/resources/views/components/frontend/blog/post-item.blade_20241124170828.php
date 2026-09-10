<div class="blog-post-item">
    <div class="post-image-wrapper">
        @if($post->image)
            <a href="{{ route('frontend.blog.show', $post->slug) }}" class="post-image-link">
                <img src="{{ asset('frontend/' . $post->image) }}" alt="{{ $post->title }}" class="post-image">
                <div class="image-overlay"></div>
            </a>
        @endif
        <div class="post-date">
            <span class="month">{{ $post->created_at->format('M') }}</span> 
            <span class="day">{{ $post->created_at->format('d') }}</span>
        </div>
    </div>
    
    <div class="post-content">
        <div class="post-meta">
            @if($post->category)
                <a href="{{ route('frontend.blog.category', $post->category->slug) }}" class="meta-item category">
                    <i class="ti-folder"></i>
                    <span>{{ $post->category->name }}</span>
                </a>
            @endif
            @foreach($post->tags as $tag)
                <a href="{{ route('frontend.blog.tag', $tag->slug) }}" class="meta-item tag">
                    <i class="ti-tag"></i>
                    <span>{{ $tag->name }}</span>
                </a>
            @endforeach
        </div>

        <h3 class="post-title">
            <a href="{{ route('frontend.blog.show', $post->slug) }}">{{ $post->title }}</a>
        </h3>

        <p class="post-excerpt">{{ Str::limit(strip_tags($post->content), 200) }}</p>

        <a href="{{ route('frontend.blog.show', $post->slug) }}" class="read-more">
            <span>Read More</span>
            <i class="ti-arrow-right"></i>
        </a>
    </div>
</div>

<style>
    .blog-post-item {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .blog-post-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    }

    /* Image Section */
    .post-image-wrapper {
        position: relative;
        overflow: hidden;
        padding-top: 60%;
    }

    .post-image-link {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: block;
    }

    .post-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.3) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .blog-post-item:hover .post-image {
        transform: scale(1.05);
    }

    .blog-post-item:hover .image-overlay {
        opacity: 1;
    }

    /* Date Badge */
    .post-date {
        position: absolute;
        top: 20px;
        right: 20px;
        background: #2095AE;
        color: #fff;
        padding: 10px 15px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(32, 149, 174, 0.2);
        z-index: 1;
    }

    .post-date .month {
        display: block;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        line-height: 1;
    }

    .post-date .day {
        display: block;
        font-size: 20px;
        font-weight: 600;
        line-height: 1.2;
    }

    /* Content Section */
    .post-content {
        padding: 30px;
    }

    .post-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 15px;
    }

    .meta-item {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 12px;
        background: #f8f9fa;
        border-radius: 20px;
        color: #666;
        font-size: 13px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .meta-item:hover {
        background: #2095AE;
        color: #fff;
        transform: translateY(-2px);
    }

    .meta-item i {
        font-size: 12px;
    }

    .post-title {
        margin: 0 0 15px;
    }

    .post-title a {
        color: #0f2454;
        text-decoration: none;
        font-size: 24px;
        font-weight: 600;
        line-height: 1.4;
        transition: color 0.3s ease;
    }

    .post-title a:hover {
        color: #2095AE;
    }

    .post-excerpt {
        color: #666;
        line-height: 1.75;
        margin-bottom: 25px;
    }

    .read-more {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 25px;
        background: #f8f9fa;
        color: #0f2454;
        text-decoration: none;
        border-radius: 25px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .read-more i {
        transition: transform 0.3s ease;
    }

    .read-more:hover {
        background: #2095AE;
        color: #fff;
    }

    .read-more:hover i {
        transform: translateX(5px);
    }

    @media (max-width: 767px) {
        .post-content {
            padding: 20px;
        }

        .post-title a {
            font-size: 20px;
        }

        .post-date {
            top: 15px;
            right: 15px;
            padding: 8px 12px;
        }
    }
</style>