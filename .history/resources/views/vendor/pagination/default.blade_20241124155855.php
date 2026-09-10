@if ($paginator->hasPages())
    <div class="blog-custom-pagination">
        <style>
            .blog-custom-pagination {
                margin-top: 40px;
            }
            .blog-custom-pagination .pagination {
                display: flex;
                justify-content: center;
                gap: 5px;
                list-style: none;
                padding: 0;
            }
            .blog-custom-pagination .page-item {
                margin: 0 2px;
            }
            .blog-custom-pagination .page-link {
                padding: 8px 16px;
                background: #f5f5f5;
                color: #333;
                border-radius: 3px;
                text-decoration: none;
                transition: all 0.3s ease;
            }
            .blog-custom-pagination .page-item.active .page-link {
                background: #333;
                color: #fff;
            }
            .blog-custom-pagination .page-link:hover {
                background: #333;
                color: #fff;
            }
            .blog-custom-pagination .page-item.disabled .page-link {
                background: #eee;
                color: #999;
                cursor: not-allowed;
            }
        </style>

        <nav>
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">&raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif 