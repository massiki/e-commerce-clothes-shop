@props(['icon', 'title', 'isActive' => '', 'isOpen' => ''])

<li class="menu-item has-children {{ $isOpen }}">
  <a href="javascript:void(0);" class="menu-item-button {{ $isActive }}">
    <div class="icon"> <i class="{{ $icon }}"></i> </div>
    <div class="text">{{ $title }}</div>
  </a>
  <ul class="sub-menu"> {{ $slot }} </ul>
</li>
