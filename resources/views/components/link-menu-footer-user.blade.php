@props(['title'])

<div class="footer-column footer-menu mb-4 mb-lg-0">
  <h6 class="sub-menu__title text-uppercase">{{ $title }}</h6>
  <ul class="sub-menu__list list-unstyled">
    {{ $slot }}
    </li>
  </ul>
</div>
