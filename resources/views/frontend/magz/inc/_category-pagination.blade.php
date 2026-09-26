@if ($paginator->hasPages())
<nav class="jtv-pg" aria-label="Pagination">
    <ul class="jtv-pg-list">
        <li>
            @if ($paginator->onFirstPage())
                <span class="jtv-pg-btn is-disabled" aria-disabled="true"><i class="fa-solid fa-chevron-left"></i></span>
            @else
                <a class="jtv-pg-btn" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous"><i class="fa-solid fa-chevron-left"></i></a>
            @endif
        </li>
        @foreach ($elements as $element)
            @if (is_string($element))
                <li><span class="jtv-pg-btn is-dots">{{ $element }}</span></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li>
                        @if ($page == $paginator->currentPage())
                            <span class="jtv-pg-btn is-active" aria-current="page">{{ $page }}</span>
                        @else
                            <a class="jtv-pg-btn" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    </li>
                @endforeach
            @endif
        @endforeach
        <li>
            @if ($paginator->hasMorePages())
                <a class="jtv-pg-btn" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next"><i class="fa-solid fa-chevron-right"></i></a>
            @else
                <span class="jtv-pg-btn is-disabled" aria-disabled="true"><i class="fa-solid fa-chevron-right"></i></span>
            @endif
        </li>
    </ul>
    <div class="jtv-pg-info">মোট {{ $paginator->total() }} টির মধ্যে {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} দেখানো হচ্ছে</div>
</nav>
@endif
