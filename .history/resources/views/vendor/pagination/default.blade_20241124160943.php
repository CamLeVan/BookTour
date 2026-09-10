@if ($paginator->hasPages())
    <div class="blog-pagination-container">
        <nav aria-label="Page navigation">
            <ul class="blog-pagination">
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
                    @if (is_string($element))
                        <li class="blog-page-item disabled">
                            <span class="blog-page-link">{{ $element }}</span>
                        </li>
                    @endif

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
    </div>

    <style>
        /* Container styles */
        .blog-pagination-container {
            margin: 40px 0;
        }

        /* Reset styles for pagination only */
        .blog-pagination {
            display: flex !important;
            justify-content: center !important;
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
            gap: 5px !important;
        }

        /* Page item styles */
        .blog-page-item {
            margin: 0 !important;
            padding: 0 !important;
            display: block !important;
            background: none !important;
        }

        /* Link styles */
        .blog-page-link {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-width: 40px !important;
            height: 40px !important;
            padding: 0 12px !important;
            background: #f5f5f5 !important;
            color: #333 !important;
            text-decoration: none !important;
            border-radius: 4px !important;
            transition: all 0.3s ease !important;
            border: none !important;
        }

        /* Active state */
        .blog-page-item.active .blog-page-link {
            background: #333 !important;
            color: #fff !important;
        }

        /* Hover state */
        .blog-page-item:not(.disabled) .blog-page-link:hover {
            background: #333 !important;
            color: #fff !important;
        }

        /* Disabled state */
        .blog-page-item.disabled .blog-page-link {
            background: #eee !important;
            color: #999 !important;
            cursor: not-allowed !important;
        }
    </style>
@endif 