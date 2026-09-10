<div class="widget">
    <div class="widget-title">
        <h6>Tags</h6>
    </div>
    <ul class="tags">
        @foreach($tags as $tag)
            <li>
                <a href="{{ route('frontend.blog.tag', $tag->slug) }}">
                    {{ $tag->name }} ({{ $tag->posts_count }})
                </a>
            </li>
        @endforeach
    </ul>
</div>

<style>
    .widget .tags {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .widget .tags li {
        margin: 0;
    }

    .widget .tags a {
        display: inline-block;
        padding: 6px 15px;
        background: #f8f9fa;
        border-radius: 30px;
        color: #666;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .widget .tags a:hover {
        background: #2095AE;
        color: #fff;
    }
</style> 