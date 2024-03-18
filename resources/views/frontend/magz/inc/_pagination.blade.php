@if ($paginator->hasPages())
<ul class="pagination justify-content-center">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <li class="page-item prev disabled">
            <a class="page-link" href="#" tabindex="-1" aria-label="Previous Disabled" aria-disabled="true">
                <i class="arrow-left"></i>
            </a>
        </li>
    @else
        <li class="page-item prev">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
            <i class="arrow-left"></i>
            </a>
        </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="page-item disabled"><a class="page-link" href="#">{{ $element }}</a></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">{{ $page }}</span>
                    </li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <li class="page-item next">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                <i class="arrow-right"></i>
            </a>
        </li>
    @else
        <li class="page-item next disabled">
            <a class="page-link" href="#" aria-label="Next Disabled">
                <i class="arrow-right"></i>
            </a>
        </li>
    @endif
</ul>
<div class="pagination-help-text text-center">
    Showing {{ $paginator->count() }} results of {{ $paginator->total() }} &mdash; Page {{ $paginator->currentPage() }}
</div>
@endif