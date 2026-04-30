<div class="section-menu-left">
  <div class="box-logo">
    <a href="#" id="site-logo-inner">
      <img class="" id="logo_header_" alt="logo" src="{{ asset('images/logo/logo.png') }}"
        data-light="{{ asset('images/logo/logo.png') }}" data-dark="{{ asset('images/logo/logo.png') }}">
    </a>
    <div class="button-show-hide">
      <i class="icon-menu-left"></i>
    </div>
  </div>
  <div class="center">
    <div class="center-item">
      <div class="center-heading">Main Home</div>
      <ul class="menu-list">
        <li class="menu-item">
          <a href="{{ route('admin.home') }}" class="{{ request()->routeIs('admin.home') ? 'active' : '' }}">
            <div class="icon"><i class="icon-grid"></i></div>
            <div class="text">Dashboard</div>
          </a>
        </li>
      </ul>
    </div>
    <div class="center-item">
      <ul class="menu-list">
        {{-- product --}}
        <x-sidebar-menu-admin icon="icon-shopping-cart" title="Products"
          isOpen="{{ request()->routeIs('admin.products.index') || request()->routeIs('admin.products.create') ? 'open active' : '' }}"
          isActive="{{ request()->routeIs('admin.products.index') || request()->routeIs('admin.products.create') ? 'active' : '' }}">
          <x-sidebar-submenu-admin href="{{ route('admin.products.create') }}" title="Add Product"
            isActive="{{ request()->routeIs('admin.products.create') ? 'active' : '' }}" />
          <x-sidebar-submenu-admin href="{{ route('admin.products.index') }}" title="Products"
            isActive="{{ request()->routeIs('admin.products.index') ? 'active' : '' }}" />
        </x-sidebar-menu-admin>
        {{-- end product --}}

        {{-- brands --}}
        <x-sidebar-menu-admin icon="icon-layers" title="Brands"
          isOpen="{{ request()->routeIs('admin.brands.index') || request()->routeIs('admin.brands.create') ? 'open active' : '' }}"
          isActive="{{ request()->routeIs('admin.brands.index') || request()->routeIs('admin.brands.create') ? 'active' : '' }}">
          <x-sidebar-submenu-admin href="{{ route('admin.brands.create') }}" title="New Brand"
            isActive="{{ request()->routeIs('admin.brands.create') ? 'active' : '' }}" />
          <x-sidebar-submenu-admin href="{{ route('admin.brands.index') }}" title="Brands"
            isActive="{{ request()->routeIs('admin.brands.index') ? 'active' : '' }}" />
        </x-sidebar-menu-admin>
        {{-- end brands --}}

        {{-- category --}}
        <x-sidebar-menu-admin icon="icon-layers" title="Category"
          isOpen="{{ request()->routeIs('admin.categories.index') || request()->routeIs('admin.categories.create') ? 'open active' : '' }}"
          isActive="{{ request()->routeIs('admin.categories.index') || request()->routeIs('admin.categories.create') ? 'active' : '' }}">
          <x-sidebar-submenu-admin href="{{ route('admin.categories.create') }}" title="New Category"
            isActive="{{ request()->routeIs('admin.categories.create') ? 'active' : '' }}" />
          <x-sidebar-submenu-admin href="{{ route('admin.categories.index') }}" title="Categories"
            isActive="{{ request()->routeIs('admin.categories.index') ? 'active' : '' }}" />
        </x-sidebar-menu-admin>
        {{-- end category --}}

        {{-- order --}}
        <x-sidebar-menu-admin icon="icon-file-plus" title="Order"
          isOpen="{{ request()->routeIs('admin.orders.index') ? 'open active' : '' }}"
          isActive="{{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
          <x-sidebar-submenu-admin href="{{ route('admin.orders.index') }}" title="Orders"
            isActive="{{ request()->routeIs('admin.orders.index') ? 'active' : '' }}" />
          <x-sidebar-submenu-admin href="#" title="Order tracking" />
        </x-sidebar-menu-admin>
        {{-- order --}}

        {{-- slider --}}
        <x-sidebar-link-admin href="{{ route('admin.sliders.index') }}" icon="icon-image" title="Slider"
          isActive="{{ request()->routeIs('admin.sliders.index') }}" />

        {{-- coupon --}}
        <x-sidebar-link-admin href="{{ route('admin.coupons.index') }}" icon="icon-grid" title="Coupons"
          isActive="{{ request()->routeIs('admin.coupons.index') ? 'active' : '' }}" />

        {{-- setting --}}
        <x-sidebar-link-admin href="#" icon="icon-user" title="User" />

        {{-- contact --}}
        <x-sidebar-link-admin href="{{ route('admin.contacts.index') }}" icon="icon-mail" title="Contact"
          isActive="{{ request()->routeIs('admin.contacts.index') ? 'active' : '' }}" />

        {{-- logout --}}
        <li class="menu-item">
          <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="icon"><i class="icon-log-out"></i></div>
            <div class="text">Log out</div>
          </a>
          <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
            @csrf
          </form>
        </li>
      </ul>
    </div>
  </div>
</div>
