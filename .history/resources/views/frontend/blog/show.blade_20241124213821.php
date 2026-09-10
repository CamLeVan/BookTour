@extends('layouts.frontend')

@section('content')
    <!-- Banner -->
    <x-frontend.blog.banner />
    
    <section class="blog2 section-padding">
        <div class="container">
            <div class="row">
                <!-- Blog Post -->
                <div class="col-md-8">
                    <div class="item">
                        @if($post->image)
                            <div class="post-img">
                                <img src="{{ asset('frontend/' . $post->image) }}" alt="{{ $post->title }}">
                                <div class="date">
                                    <span>{{ $post->created_at->format('M') }}</span>
                                    <i>{{ $post->created_at->format('d') }}</i>
                                </div>
                            </div>
                        @endif
                        
                        <div class="post-cont">
                            <h5>{{ $post->title }}</h5>
                            <x-frontend.blog.post-meta :post="$post" />
                            <div class="post-content">{!! $post->content !!}</div>
                            <x-frontend.blog.post-tags :tags="$post->tags" />
                        </div>
                    </div>
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
    /* Giữ nguyên CSS hiện tại của bạn */
    .blog2 { ... }
    .item
</style>
@endPushOnce 