@if ($paginator->hasPages())
  <nav class="pagination" aria-label="Сторінки каталогу">
    @if ($paginator->onFirstPage())
      <span class="pagination__item pagination__item--disabled" aria-hidden="true">←</span>
    @else
      <a class="pagination__item" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Попередня сторінка">←</a>
    @endif

    @foreach ($elements as $element)
      @if (is_string($element))
        <span class="pagination__item pagination__item--gap">{{ $element }}</span>
      @endif
      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
            <span class="pagination__item pagination__item--active" aria-current="page">{{ $page }}</span>
          @else
            <a class="pagination__item" href="{{ $url }}">{{ $page }}</a>
          @endif
        @endforeach
      @endif
    @endforeach

    @if ($paginator->hasMorePages())
      <a class="pagination__item" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Наступна сторінка">→</a>
    @else
      <span class="pagination__item pagination__item--disabled" aria-hidden="true">→</span>
    @endif
  </nav>
@endif