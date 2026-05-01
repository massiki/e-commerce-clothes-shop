@if ($paginator->hasPages())
  <div class="shop-pages d-flex justify-content-between mt-3" aria-label="Page navigation">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
      <span class="btn-link d-inline-flex align-items-center disabled" aria-disabled="true">
        <svg class="me-1" width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
          <use href="#icon_prev_sm" />
        </svg>
        <span class="fw-medium">PREV</span>
      </span>
    @else
      <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="btn-link d-inline-flex align-items-center">
        <svg class="me-1" width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
          <use href="#icon_prev_sm" />
        </svg>
        <span class="fw-medium">PREV</span>
      </a>
    @endif

    {{-- Pagination Elements --}}
    <ul class="pagination mb-0">
      @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
          <li class="page-item disabled" aria-disabled="true">
            <span class="btn-link px-1 mx-2">{{ $element }}</span>
          </li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <li class="page-item active" aria-current="page">
                <span class="btn-link px-1 mx-2 btn-link_active">{{ $page }}</span>
              </li>
            @else
              <li class="page-item">
                <a class="btn-link px-1 mx-2" href="{{ $url }}">{{ $page }}</a>
              </li>
            @endif
          @endforeach
        @endif
      @endforeach
    </ul>

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="btn-link d-inline-flex align-items-center">
        <span class="fw-medium me-1">NEXT</span>
        <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
          <use href="#icon_next_sm" />
        </svg>
      </a>
    @else
      <span class="btn-link d-inline-flex align-items-center disabled" aria-disabled="true">
        <span class="fw-medium me-1">NEXT</span>
        <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
          <use href="#icon_next_sm" />
        </svg>
      </span>
    @endif
  </div>
@endif
