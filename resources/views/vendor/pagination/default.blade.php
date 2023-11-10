@if ($paginator->hasPages())
    <div id="pagination">
        <div class="pageno">
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="pageno current" aria-current="page"><span>{{ $page }}</span></a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
        </div>
        <div class="flex">
            @if (!$paginator->onFirstPage())
                <a class="prev" href="{{ $paginator->previousPageUrl() }}" rel="prev">前へ</a>
            @endif            
            @if ($paginator->hasMorePages())
                <a class="next" href="{{ $paginator->nextPageUrl() }}" rel="next">次へ</a>
            @endif            
        </div>    
    </div>
@endif
