@extends('layouts.frontend')

@section('content')
    <!-- Banner -->
    <x-frontend.blog.banner />
    
    <!-- Blog Section -->
    <section class="blog-section section-padding">
        <div class="container">
            <div class="row">
                <!-- Blog Posts -->
                <div class="col-md-8">
                    @if(isset($category))
                        <div class="col-md-12 mb-30">
                            <h4>Danh mục: {{ $category->name }}</h4>
                        </div>
                    @elseif(isset($tag))
                        <div class="col-md-12 mb-30">
                            <h4>Tag: {{ $tag->name }}</h4>
                        </div>
                    @endif

                    @if($posts->isEmpty())
                        <div class="alert alert-info">No posts found.</div>
                    @else
                        @foreach($posts as $post)
                            <x-frontend.blog.post-item :post="$post" />
                        @endforeach

                        <x-frontend.blog.pagination :paginator="$posts" />
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

@pushOnce('styles')
<style>
    .blog-section {
        position: relative;
        background: #fff;
        padding: 80px 0;
        min-height: calc(100vh - 500px);
    }
</style>
@endPushOnce
