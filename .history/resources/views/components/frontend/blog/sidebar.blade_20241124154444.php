<div class="blog-sidebar">
    <style scoped>
        .blog-sidebar {
            background: #fff;
            padding: 25px;
            border-radius: 5px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        }
        .sidebar-widget {
            margin-bottom: 30px;
        }
        .widget-title {
            font-size: 1.2rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eee;
            color: #333;
        }
        .recent-posts li {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .recent-posts li:last-child {
            border-bottom: none;
        }
        .recent-posts a {
            color: #555;
            text-decoration: none;
        }
        .recent-posts a:hover {
            color: #333;
        }
        .categories-list li,
        .archives-list li {
            margin-bottom: 10px;
        }
        .categories-list a,
        .archives-list a {
            color: #666;
            text-decoration: none;
            display: flex;
            justify-content: space-between;
        }
        .categories-list a:hover,
        .archives-list a:hover {
            color: #333;
        }
        .tag-cloud {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .tag-cloud a {
            padding: 5px 12px;
            background: #f5f5f5;
            border-radius: 3px;
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .tag-cloud a:hover {
            background: #333;
            color: #fff;
        }
    </style>

    <!-- Recent Posts -->
    <div class="sidebar-widget">
        <h4 class="widget-title">Recent Posts</h4>
        <ul class="recent-posts list-unstyled">
            @foreach($recentPosts as $recentPost)
                <li>
                    <a href="{{ route('frontend.blog.show', $recentPost->slug) }}">
                        {{ $recentPost->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Categories -->
    <div class="sidebar-widget">
        <h4 class="widget-title">Categories</h4>
        <ul class="categories-list list-unstyled">
            @foreach($categories as $category)
                <li>
                    <a href="{{ route('frontend.blog.category', $category->slug) }}">
                        {{ $category->name }}
                        <span>({{ $category->posts_count }})</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Archives -->
    <div class="sidebar-widget">
        <h4 class="widget-title">Archives</h4>
        <ul class="archives-list list-unstyled">
            @foreach($archives as $archive)
                <li>
                    <a href="{{ route('frontend.blog.archive', [$archive->year, $archive->month]) }}">
                        {{ $archive->month_name }} {{ $archive->year }}
                        <span>({{ $archive->post_count }})</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Tags -->
    <div class="sidebar-widget">
        <h4 class="widget-title">Tags</h4>
        <div class="tag-cloud">
            @foreach($tags as $tag)
                <a href="{{ route('frontend.blog.tag', $tag->slug) }}">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>
    </div>
</div> 