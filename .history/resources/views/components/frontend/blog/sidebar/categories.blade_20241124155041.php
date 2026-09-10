<div class="widget">
    <div class="widget-title">
        <h6>Categories</h6>
    </div>
    <ul>
        @foreach($categories as $category)
            <li>
                <a href="{{ route('frontend.blog.category', $category->slug) }}">
                    <i class="ti-angle-right"></i>{{ $category->name }}
                    <span>({{ $category->posts_count }})</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>

<style>
    /* Sử dụng lại style của archives */
</style> 