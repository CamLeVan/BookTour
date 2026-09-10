@if ($paginator->hasPages())
    <div class="blog-pagination">
        <style scoped>
            .blog-pagination {
                margin-top: 40px;
            }
            .pagination {
                display: flex;
                justify-content: center;
                gap: 5px;
                list-style: none;
                padding: 0;
            }
            .page-item {
                margin: 0 2px;
            }
            .page-link {
                padding: 8px 16px;
                background: #f5f5f5;
                color: #333;
                border-radius: 3px;
                text-decoration: none;
                transition: all 0.3s ease;
            }
            .page-item.active .page-link {
                background: #333;
                color: #fff;
            }
            .page-link:hover {
                background: #333;
                color: #fff;
            }
            .page-item.disabled .page-link {
                background: #eee;
                color: #999;
                cursor: not-allowed;
            }
        </style>

        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
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
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">&raquo;</span>
                </li>
            @endif
        </ul>
    </div>
@endif