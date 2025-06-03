@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li><span class="page-btn disabled">←</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" class="page-btn">←</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <a href="{{ $url }}" class="page-btn active">{{ $page }}</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" class="page-btn">→</a></li>
            @else
                <li><span class="page-btn disabled">→</span></li>
            @endif
        </ul>
    </nav>
@endif

<style>
    /* Pagination container */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    /* All pagination buttons */
    .page-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        font-size: 16px;
        border: 2px solid gray;
        border-radius: 6px;
        text-decoration: none;
        color: black;
        transition: 0.3s;
    }

    /* Hover effect */
    .page-btn:hover {
        background-color: #f0f0f0;
    }

    /* Active (current) page button */
    .page-btn.active {
        border-color: blue;
        color: blue;
        font-weight: bold;
    }

    /* Disabled (unclickable) arrows */
    .page-btn.disabled {
        color: lightgray;
        border-color: lightgray;
        cursor: not-allowed;
    }
</style>
