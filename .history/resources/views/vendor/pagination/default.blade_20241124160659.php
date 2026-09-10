@if ($paginator->hasPages())
    <nav class="blog-pagination" aria-label="Page navigation">
        <ul class="blog-pagination-list">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="blog-page-item disabled">
                    <span class="blog-page-link">&laquo;</span>
                </li>
            @else
                <li class="blog-page-item">
                    <a class="blog-page-link" href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="blog-page-item disabled">
                        <span class="blog-page-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="blog-page-item active">
                                <span class="blog-page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="blog-page-item">
                                <a class="blog-page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="blog-page-item">
                    <a class="blog-page-link" href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
                </li>
            @else
                <li class="blog-page-item disabled">
                    <span class="blog-page-link">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>

    <style>
        /* Scoped pagination styles */
        .blog-pagination {
            display: flex;
            justify-content: center;
        }
        
        .blog-pagination-list {
            display: flex;
            gap: 5px;
            margin: 0;
            padding: 0;
            list-style: none;
        }
        
        .blog-page-item {
            margin: 0;
        }
        
        .blog-page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 12px;
            background: #f5f5f5;
            color: #333;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        
        .blog-page-item.active .blog-page-link {
            background: #333;
            color: #fff;
        }
        
        .blog-page-item:not(.disabled) .blog-page-link:hover {
            background: #333;
            color: #fff;
        }
        
        .blog-page-item.disabled .blog-page-link {
            background: #eee;
            color: #999;
            cursor: not-allowed;
        }
    </style>
@endif 