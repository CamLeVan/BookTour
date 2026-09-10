@extends('layouts.frontend')
@push('styles')
<style>
    /* Blog Post Container */
    .blog2 {
        padding: 80px 0;
        background: #fff;
    }

    /* Post Item */
    .item {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 30px rgba(0,0,0,0.06);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    /* Post Image */
    .post-img {
        position: relative;
        overflow: hidden;
        border-radius: 16px 16px 0 0;
    }

    .post-img::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.1) 100%);
        pointer-events: none;
    }

    .post-img img {
        width: 100%;
        height: auto;
        transform: scale(1);
        transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .item:hover .post-img img {
        transform: scale(1.05);
    }

    /* Date Badge */
    .date {
        position: absolute;
        top: 20px;
        right: 20px;
        background: linear-gradient(45deg, #2095AE, #26A7C2);
        color: #fff;
        padding: 10px 15px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(32, 149, 174, 0.2);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255,255,255,0.1);
        z-index: 1;
    }

    .date span {
        display: block;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        line-height: 1;
    }

    .date i {
        display: block;
        font-size: 22px;
        font-weight: 600;
        font-style: normal;
        line-height: 1.2;
    }

    /* Post Content */
    .post-cont {
        padding: 40px;
    }

    .post-cont h5 {
        font-size: 32px;
        font-weight: 700;
        color: #0f2454;
        margin-bottom: 20px;
        line-height: 1.4;
    }

    /* Meta Info */
    .info {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 30px;
        padding: 15px;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.05);
    }

    .info a {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: #f8f9fa;
        border-radius: 25px;
        color: #666;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .info a:hover {
        background: #2095AE;
        color: #fff;
        transform: translateY(-2px);
    }

    .info a i {
        font-size: 12px;
        color: #2095AE;
        transition: color 0.3s ease;
    }

    .info a:hover i {
        color: #fff;
    }

    .info .post-date {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: #f8f9fa;
        border-radius: 25px;
        color: #666;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .info .post-date:hover {
        background: #2095AE;
        color: #fff;
        transform: translateY(-2px);
    }

    .info .post-date i {
        font-size: 12px;
        color: #2095AE;
        transition: color 0.3s ease;
    }

    .info .post-date:hover i {
        color: #fff;
    }

    /* Post Content */
    .post-content {
        color: #666;
        line-height: 1.8;
        font-size: 16px;
    }

    .post-content p {
        margin-bottom: 20px;
    }

    .post-content img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 30px 0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .post-content h1, 
    .post-content h2, 
    .post-content h3, 
    .post-content h4, 
    .post-content h5, 
    .post-content h6 {
        color: #0f2454;
        margin: 30px 0 20px;
        font-weight: 600;
    }

    /* Content Links */
    .post-content a {
        color: #2095AE;
        text-decoration: none;
        border-bottom: 1px dashed #2095AE;
        transition: all 0.3s ease;
    }

    .post-content a:hover {
        color: #0f2454;
        border-bottom-style: solid;
    }

    /* Blockquotes */
    .post-content blockquote {
        padding: 30px;
        background: #f8f9fa;
        border-left: 4px solid #2095AE;
        margin: 30px 0;
        border-radius: 0 12px 12px 0;
        font-style: italic;
        color: #0f2454;
    }

    .post-content blockquote p:last-child {
        margin-bottom: 0;
    }

    /* Lists */
    .post-content ul, 
    .post-content ol {
        padding-left: 20px;
        margin-bottom: 20px;
    }

    .post-content li {
        margin-bottom: 10px;
        color: #666;
    }

    /* Code Blocks */
    .post-content pre {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
        overflow-x: auto;
        margin: 30px 0;
        border: 1px solid #eef0f3;
    }

    .post-content code {
        background: #f1f3f4;
        padding: 3px 6px;
        border-radius: 4px;
        font-size: 14px;
        color: #2095AE;
    }

    /* Tables */
    .post-content table {
        width: 100%;
        margin: 30px 0;
        border-collapse: collapse;
    }

    .post-content th,
    .post-content td {
        padding: 12px;
        border: 1px solid #eef0f3;
        text-align: left;
    }

    .post-content th {
        background: #f8f9fa;
        color: #0f2454;
        font-weight: 600;
    }

    /* Tags Section */
    .tags-section {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #eef0f3;
    }

    .tags-section h6 {
        font-size: 18px;
        color: #0f2454;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .tag {
        display: inline-block;
        padding: 8px 16px;
        margin: 5px;
        background: #f8f9fa;
        border-radius: 25px;
        color: #666;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .tag:hover {
        background: #2095AE;
        color: #fff;
        transform: translateY(-2px);
    }

    /* Responsive */
    @media (max-width: 767px) {
        .post-cont {
            padding: 25px;
        }

        .post-cont h5 {
            font-size: 24px;
        }

        .date {
            padding: 8px 12px;
            top: 15px;
            right: 15px;
        }

        .info {
            gap: 8px;
        }

        .info a {
            padding: 6px 12px;
            font-size: 13px;
        }

        .post-content blockquote {
            padding: 20px;
        }
    }
</style>
@endpush
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
                                <img src="{{ asset('frontend/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                            </div>
                        @endif
                        
                        <div class="post-cont">
                            <h5>{{ $post->title }}</h5>
                            
                            <div class="info">
                                <span class="post-date">
                                    <i class="ti-calendar"></i> {{ $post->created_at->format('d M, Y') }}
                                </span>
                                
                                @if($post->category)
                                    <a href="{{ route('frontend.blog.category', $post->category->slug) }}">
                                        <i class="ti-folder"></i> {{ $post->category->name }}
                                    </a>
                                @endif
                                
                                @foreach($post->tags as $tag)
                                    <a href="{{ route('frontend.blog.tag', $tag->slug) }}">
                                        <i class="ti-tag"></i> {{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                            
                            <div class="post-content">
                                {!! $post->content !!}
                            </div>
                            
                            <!-- Tags -->
                            @if($post->tags->count() > 0)
                                <div class="tags-section mt-30">
                                    <h6>Tags:</h6>
                                    @foreach($post->tags as $tag)
                                        <a href="{{ route('frontend.blog.tag', $tag->slug) }}" class="tag">
                                            {{ $tag->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
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