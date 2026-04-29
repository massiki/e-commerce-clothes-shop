@extends('layouts.app')

@section('content')
  <main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
      <h2 class="page-title">Cart</h2>
      @auth
        <div class="checkout-steps">
          <a href="javacript:void(0)" class="checkout-steps__item active">
            <span class="checkout-steps__item-number">01</span>
            <span class="checkout-steps__item-title">
              <span>Shopping Bag</span>
              <em>Manage Your Items List</em>
            </span>
          </a>
          <a href="javacript:void(0)" class="checkout-steps__item">
            <span class="checkout-steps__item-number">02</span>
            <span class="checkout-steps__item-title">
              <span>Shipping and Checkout</span>
              <em>Checkout Your Items List</em>
            </span>
          </a>
          <a href="javacript:void(0)" class="checkout-steps__item">
            <span class="checkout-steps__item-number">03</span>
            <span class="checkout-steps__item-title">
              <span>Confirmation</span>
              <em>Review And Submit Your Order</em>
            </span>
          </a>
        </div>
        <div class="shopping-cart">
          <div class="cart-table__wrapper">
            <table class="cart-table">
              <thead>
                <tr>
                  <th>Product</th>
                  <th></th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Subtotal</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @forelse ($cartItems as $item)
                  @php
                    $price = $item->product->sale_price ?? $item->product->regular_price;
                  @endphp
                  <tr>
                    <td>
                      <div class="shopping-cart__product-item">
                        <img loading="lazy" src="{{ asset('storage/' . $item->product->image) }}" width="120"
                          height="120" alt="" />
                      </div>
                    </td>
                    <td>
                      <div class="shopping-cart__product-item__detail">
                        <h4>{{ $item->product->name }}</h4>
                        <ul class="shopping-cart__product-item__options">
                          <li>Color: -</li>
                          <li>Size: -</li>
                        </ul>
                      </div>
                    </td>
                    <td>
                      <span class="shopping-cart__product-price">Rp
                        {{ number_format($price, 0, ',', '.') }}</span>
                    </td>
                    <td>
                      <div class="qty-control position-relative">
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                          class="qty-control__number text-center">
                        <form action="{{ route('user.cart.decrease') }}" method="post">
                          @method('patch')
                          @csrf
                          <input type="hidden" value="{{ $item->product_id }}" name="productId">
                          <button class="btn qty-control__reduce">-</button>
                        </form>
                        <form action="{{ route('user.cart.increase') }}" method="post">
                          @method('patch')
                          @csrf
                          <input type="hidden" value="{{ $item->product_id }}" name="productId">
                          <button class="btn qty-control__increase">+</button>
                        </form>
                      </div>
                    </td>
                    <td>
                      <span class="shopping-cart__subtotal">Rp
                        {{ number_format($price * $item->quantity, 0, ',', '.') }}</span>
                    </td>
                    <td>
                      <form action="{{ route('user.destroy', $item->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn remove-cart">
                          <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                            <path d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                          </svg>
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center">
                      <div class="my-5 py-5">
                        <p class="mb-3">Your shopping cart is empty.</p>
                        <a href="{{ route('shop') }}" class="btn btn-primary">
                          Start Shopping
                        </a>
                      </div>
                    </td>
                  </tr>
                @endforelse

              </tbody>
            </table>
            <div class="cart-table-footer">
              <form action="{{ session()->has('coupon') ? route('user.remove.coupon') : route('user.apply.coupon') }}"
                method="post" class="position-relative bg-body">
                <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code"
                  value="{{ session('coupon.code') }}">
                <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit"
                  value="{{ session()->has('coupon') ? 'REMOVE COUPON' : 'APPLY COUPON' }}">
              </form>
              <form action="{{ route('user.destroy.all') }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-light">DELETE ALL CART</button>
              </form>
            </div>
            @if ($errors->has('coupon_code'))
              <span class="text-red">{{ $errors->first('coupon_code') }}</span>
            @endif

            @if (session('error'))
              <span class="text-red">{{ session('error') }}</span>
            @elseif (session('success'))
              <span style="color: green">{{ session('success') }}</span>
            @elseif (session()->has('coupon'))
              <span style="color: green">Coupon applied successfully!</span>
            @endif

          </div>
          <div class="shopping-cart__totals-wrapper">
            <div class="sticky-content">
              <div class="shopping-cart__totals">
                <h3>Cart Totals</h3>
                @php
                  $cartTotal = 0;
                  foreach ($cartItems as $item) {
                      $price = $item->product->sale_price ?? $item->product->regular_price;
                      $cartTotal += $price * $item->quantity;
                  }
                @endphp

                <table class="cart-totals">
                  <tbody>
                    <tr>
                      <th>Subtotal</th>
                      <td>
                        Rp {{ number_format($cartTotal ?? 0, 0, ',', '.') }}
                      </td>
                    </tr>
                    @if (session()->has('coupon'))
                      <tr>
                        <th>Discount ({{ session('coupon.code') }})</th>
                        <td>- Rp {{ number_format(session('coupon.discount'), 0, ',', '.') }}</td>
                      </tr>
                    @endif
                    <tr>
                      <th>Shipping</th>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input form-check-input_fill" type="radio" name="shipping"
                            id="free_shipping" checked>
                          <label class="form-check-label" for="free_shipping">Free shipping</label>
                        </div>
                        <div>Shipping to Indonesia.</div>
                        <div>
                          <a href="#" class="menu-link menu-link_us-s">CHANGE ADDRESS</a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th>VAT</th>
                      <td>Rp 0</td>
                    </tr>
                    <tr>
                      <th>Total</th>
                      <td>Rp {{ number_format($cartTotal - session('coupon.discount'), 0, ',', '.') }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="mobile_fixed-btn_wrapper">
                <div class="button-wrapper container">
                  <a href="{{ route('user.checkout') }}" class="btn btn-primary btn-checkout">PROCEED TO CHECKOUT</a>
                </div>
              </div>
            </div>
          </div>

        </div>
      @else
        <div class="alert alert-warning mt-4 mb-4 text-center" role="alert">
          Anda harus <strong>login</strong> terlebih dahulu untuk melihat dan mengelola keranjang belanja Anda.
        </div>
        <div class="text-center">
          <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        </div>
      @endauth

    </section>
  </main>
@endsection
