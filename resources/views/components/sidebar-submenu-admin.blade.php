@props(['href', 'title', 'isActive' => ''])

<li class="sub-menu-item">
  <a href="{{ $href }}" class="{{ $isActive }}">
    <div class="text">{{ $title }}</div>
  </a>
</li>
