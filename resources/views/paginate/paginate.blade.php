@if ($paginator->hasPages() && $paginator->total() > 1)

    <ul class="pagination page-nav">
        @if ($paginator->onFirstPage())

            {{--<li class="disabled page-nav__item"><span>&laquo;</span></li>--}}

        @else
            <li class="page-nav__item"><a href="{{ $paginator->previousPageUrl() }}" class="page-nav__item__link"><i
                            class="fa fa-angle-double-left"></i></a></li>
            {{--<li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>--}}

        @endif
        @foreach ($elements as $element)
            @if (is_string($element))

                <li class="disabled page-nav__item"><span>{{ $element }}</span></li>

            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())

                        <li class="active page-nav__item"><span>{{ $page }}</span></li>

                    @else

                        <li class="page-nav__item"><a href="{{ $url }}">{{ $page }}</a></li>

                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
                <li class="page-nav__item">
                    <a href="{{ $paginator->nextPageUrl() }}" class="page-nav__item__link">
                        <i class="fa fa-angle-double-right"></i>
                    </a>
                </li>
{{--<li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>--}}

        @else

            {{--<li class="disabled"><span>&raquo;</span></li>--}}

        @endif
    </ul>
@endif
