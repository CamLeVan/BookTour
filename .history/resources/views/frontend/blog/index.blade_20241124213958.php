@extends('layouts.frontend')

@section('content')
    <!-- Banner -->
    <x-frontend.blog.banner />
    
    <!-- Blog Section -->
    <section class="blog-section section-padding">
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
                @endifz

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

                        <!-- Pagination -->
                        <div class="blog-pagination-wrapper">
                            <x-frontend.blog.pagination :paginator="$posts" />
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

@push('styles')
<style>
    /* Blog section specific styles */
    .blog-section {
        position: relative;
        background: #fff;
        padding: 80px 0;
    }
    
    /* Pagination wrapper */
    .blog-pagination-wrapper {
        margin-top: 40px;
        margin-bottom: 40px;
    }

    /* Reset any inherited styles */
    .blog-pagination-wrapper ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    /* Ensure footer stays at bottom */
    .blog-section {
        min-height: calc(100vh - 500px); /* Adjust value based on your header/footer height */
    }
</style>
@endpush
