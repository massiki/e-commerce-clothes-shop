<div class="col-lg-2">
  <ul class="account-nav">
    <li>
      <a href="{{ route('user.home') }}"
        class="menu-link menu-link_us-s{{ request()->routeIs('user.home') ? ' menu-link_active' : '' }}">Dashboard</a>
    </li>
    <li>
      <a href="{{ route('user.orders.index') }}"
        class="menu-link menu-link_us-s{{ request()->routeIs('user.orders.index') ? ' menu-link_active' : '' }}">Orders</a>
    </li>
    <li>
      <a href="#"
        class="menu-link menu-link_us-s{{ request()->routeIs('user.addresses.index') ? ' menu-link_active' : '' }}">Addresses</a>
    </li>
    <li>
      <a href="#"
        class="menu-link menu-link_us-s{{ request()->routeIs('user.account.details') ? ' menu-link_active' : '' }}">Account
        Details</a>
    </li>
    <li>
      <a href="#"
        class="menu-link menu-link_us-s{{ request()->routeIs('user.wishlists.index') ? ' menu-link_active' : '' }}">Wishlist</a>
    </li>
    <li>
      <form method="POST" action="{{ route('logout') }}" id="logout-form-sidebar">
        @csrf
        <a href="{{ route('logout') }}" class="menu-link menu-link_us-s"
          onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">Logout</a>
      </form>
    </li>
  </ul>
</div>
