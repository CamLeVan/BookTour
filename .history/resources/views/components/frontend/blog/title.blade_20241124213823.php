@if(isset($category))
    <div class="col-md-12 mb-30">
        <h4>Danh mục: {{ $category->name }}</h4>
    </div>
@elseif(isset($tag))
    <div class="col-md-12 mb-30">
        <h4>Tag: {{ $tag->name }}</h4>
    </div>
@elseif($query)
    <div class="col-md-12 mb-30">
        <h4>Search results for: "{{ $query }}"</h4>
    </div>
@endif 