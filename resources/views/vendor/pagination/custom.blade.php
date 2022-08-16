<style type="text/css">
    ul li {
        display: inline;
    }

    .pagination ul li {
        color: black;
        float: left;
        padding: 8px 16px;
        transition: background-color .3s;
        /* border: 1px solid #ddd; */
        margin: 0 4px;
    }

    .pagination ul a li {
        text-decoration: none;
        color: #174a17;
    }

    .pagination ul li.active {
        background-color: #174a17;
        color: white;
        border: 1px solid #4CAF50;
    }

</style>

@if ($paginator->hasPages())
    <div class="center">
        <div class="pagination">
            <ul class="pager" style="list-style-type: none;">

                @if ($paginator->onFirstPage())
                    <li class="disabled"><span>← Previous</span></li>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <li>← Previous</li>
                    </a>
                @endif

                @foreach ($elements as $element)

                    @if (is_string($element))
                        <li class="disabled"><span>{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active my-active"><span>{{ $page }}</span></li>
                            @else
                                <a href="{{ $url }}">
                                    <li>{{ $page }}</li>
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <li>Next →</li>
                    </a>
                @else
                    <li class="disabled"><span>Next →</span></li>
                @endif
            </ul>
        </div>
    </div>
@endif
