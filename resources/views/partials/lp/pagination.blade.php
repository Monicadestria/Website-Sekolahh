<nav aria-label="Pagination">
    <ul class="pagination justify-content-end px-3">
      <li class="page-item">
        <a class="page-link disabled" id="previous_paginator" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Sebelumnya">Sebelumnya</a>
      </li>


      @foreach ($elements as $element)
        @if (is_string($element))
        <li class="page-item disabled" aria-disabled="true">
          <span class="page-link">{{ $element }}</span>
        </li>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <li class="page-item" aria-current="page">
                  <a class="page-link item_{{$page}} active item_paginator" href="{{ $url }}" data-page="{{ $page }}">{{ $page }}</a>
                </li>
                @else
                <li class="page-item" aria-current="page">
                  <a class="page-link item_{{$page}} item_paginator" href="{{ $url }}" data-page="{{ $page }}">{{ $page }}</a>
                </li>
                @endif
            @endforeach
        @endif
      @endforeach

      @if ($paginator->hasMorePages())
      <li class="page-item">
        <a class="page-link" id="next_paginator" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Selanjutnya">Selanjutnya</a>
      </li>
      @else
      <li class="page-item disabled" aria-disabled="true">
        <span class="page-link" aria-hidden="true">Selanjutnya</span>
      </li>
      @endif
    </ul>
</nav>