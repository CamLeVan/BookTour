<div class="col-md-12">
    <div class="widget">
        <div class="widget-title">
            <h6>Categories</h6>
        </div>
        <ul>
            @foreach($categories as $category)
            <li>
                <a href="{{ route('frontend.blog.category', $category->slug) }}">
                    <i class="ti-angle-right"></i>{{ $category->name }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div> 