@props(['title', 'href' => '#'])

<li class="sub-menu__item">
  <a href="{{ $href }}" target="_blank" class="menu-link menu-link_us-s">
    {{ $title }}
  </a>
</li>
