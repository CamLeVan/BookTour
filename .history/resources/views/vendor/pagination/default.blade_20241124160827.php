@if ($paginator->hasPages())
    <nav class="hc-blog-pagination" aria-label="Page navigation">
        <ul class="hc-blog-pagination-list">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="hc-blog-page-item disabled">
                    <span class="hc-blog-page-link">&laquo;</span>
                </li>
            @else
                <li class="hc-blog-page-item">
                    <a class="hc-blog-page-link" href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="hc-blog-page-item disabled">
                        <span class="hc-blog-page-link">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="hc-blog-page-item active">
                                <span class="hc-blog-page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="hc-blog-page-item">
                                <a class="hc-blog-page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="hc-blog-page-item">
                    <a class="hc-blog-page-link" href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
                </li>
            @else
                <li class="hc-blog-page-item disabled">
                    <span class="hc-blog-page-link">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>

    <style>
        /* Scoped pagination styles */
        .hc-blog-pagination {
            display: flex;
            justify-content: center;
        }
        
        .hc-blog-pagination-list {
            display: flex;
            gap: 5px;
            margin: 0;
            padding: 0;
            list-style: none;
        }
        
        .hc-blog-page-item {
            margin: 0;
        }
        
        .hc-blog-page-link {
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
        
        .hc-blog-page-item.active .hc-blog-page-link {
            background: #333;
            color: #fff;
        }
        
        .hc-blog-page-item:not(.disabled) .hc-blog-page-link:hover {
            background: #333;
            color: #fff;
        }
        
        .hc-blog-page-item.disabled .hc-blog-page-link {
            background: #eee;
            color: #999;
            cursor: not-allowed;
        }
    </style>
@endif 