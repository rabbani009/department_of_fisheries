@if ($paginator->hasPages())

    <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
        <ul class="pagination">

            @if ($paginator->onFirstPage())
                <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a
                        class="page-link"><i class="ti-angle-left"></i></a></li>
            @else
                <li class="paginate_button page-item previous" id="DataTables_Table_0_previous"><a
                        href="{{ $paginator->previousPageUrl() }}" class="page-link"><i
                            class="ti-angle-left"></i></a></li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="paginate_button page-item"><a class="page-link">{{ $element }}</a></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="paginate_button page-item active"><a
                                    class="page-link">{{ $page }}</a></li>
                        @else
                            <li class="paginate_button page-item"><a href="{{ $url }}"
                                    class="page-link">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li class="paginate_button page-item next" id="DataTables_Table_0_next"><a
                        href="{{ $paginator->nextPageUrl() }}" class="page-link"><i
                            class="ti-angle-right"></i></a></li>
            @else
                <li class="paginate_button page-item next  disabled" id="DataTables_Table_0_next"><a
                        class="page-link"><i class="ti-angle-right"></i></a></li>
            @endif
        </ul>

    </div>

@endif
