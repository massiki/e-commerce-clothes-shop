@props(['href', 'icon', 'title', 'isActive' => false])

<li class="menu-item{{ $isActive ? ' active' : '' }}">
  <a href="{{ $href }}" class="{{ $isActive ? 'active' : '' }}">
    <div class="icon"><i class="{{ $icon }}"></i></div>
    <div class="text">{{ $title }}</div>
  </a>
</li>
