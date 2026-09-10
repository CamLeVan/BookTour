@extends('layouts.frontend')

@section('content')
    <!-- Banner -->
    <x-frontend.blog.banner />
    
    <!-- Blog Section -->
    <section class="blog2 section-padding">
        <div class="container">
            <div class="row">
                <!-- Title for category/tag pages -->
                @if(isset($category))
                    <div class="col-md-12 mb-30">
                        <h4>Danh mục: {{ $category->name }}</h4>
                    </div>
                @elseif(isset($tag))
                    <div class="col-md-12 mb-30">
                        <h4>Tag: {{ $tag->name }}</h4>
                    </div>
                @endif

                <!-- Blog Posts -->
                <div class="col-md-8">
                    @if(request()->has('query'))
                        <div class="mb-4">
                            <h4>Search results for: "{{ request('query') }}"</h4>
                        </div>
                    @endif

                    @if($posts->isEmpty())
                        <div class="alert alert-info">
                            No posts found.
                        </div>
                    @else
                        @foreach($posts as $post)
                            <x-frontend.blog.post-item :post="$post" />
                        @endforeach

                        <div class="pagination-wrapper">
                            {{ $posts->links('components.frontend.blog.pagination') }}
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <x-frontend.blog.sidebar 
                        :recentPosts="$recentPosts"
                        :categories="$categories"
                        :archives="$archives"
                        :tags="$tags"
                    />
                </div>
            </div>
        </div>
    </section>
@endsection
