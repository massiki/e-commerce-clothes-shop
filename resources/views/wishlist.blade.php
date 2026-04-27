@extends('layouts.app')

@section('content')
  <main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
      <h2 class="page-title">Wishlist</h2>
      @auth

        <div class="checkout-steps">
          <a href="shop_cart.html" class="checkout-steps__item active">
            <span class="checkout-steps__item-number">01</span>
            <span class="checkout-steps__item-title">
              <span>Shopping Bag</span>
              <em>Manage Your Items List</em>
            </span>
          </a>
          <a href="shop_checkout.html" class="checkout-steps__item">
            <span class="checkout-steps__item-number">02</span>
            <span class="checkout-steps__item-title">
              <span>Shipping and Checkout</span>
              <em>Checkout Your Items List</em>
            </span>
          </a>
          <a href="shop_order_complete.html" class="checkout-steps__item">
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
                  <th>Action</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="shopping-cart__product-item">
                      <img loading="lazy" src="../images/cart-item-1.html" width="120" height="120" alt="" />
                    </div>
                  </td>
                  <td>
                    <div class="shopping-cart__product-item__detail">
                      <h4>Zessi Dresses</h4>
                      <ul class="shopping-cart__product-item__options">
                        <li>Color: -</li>
                        <li>Size: -</li>
                      </ul>
                    </div>
                  </td>
                  <td>
                    <span class="shopping-cart__product-price">$99</span>
                  </td>
                  <td>
                    <span>3</span>
                  </td>
                  <td>
                    <span class="shopping-cart__subtotal">$297</span>
                  </td>
                  <td>
                    <a href="#" class="remove-cart">
                      <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                        <path d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                      </svg>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="shopping-cart__product-item">
                      <img loading="lazy" src="../images/cart-item-2.html" width="120" height="120" alt="" />
                    </div>
                  </td>
                  <td>
                    <div class="shopping-cart__product-item__detail">
                      <h4>Kirby T-Shirt</h4>
                      <ul class="shopping-cart__product-item__options">
                        <li>Color: Yellow</li>
                        <li>Size: L</li>
                      </ul>
                    </div>
                  </td>
                  <td>
                    <span class="shopping-cart__product-price">$99</span>
                  </td>
                  <td>
                    <div class="qty-control position-relative">
                      <input type="number" name="quantity" value="3" min="1"
                        class="qty-control__number text-center">
                      <div class="qty-control__reduce">-</div>
                      <div class="qty-control__increase">+</div>
                    </div><!-- .qty-control -->
                  </td>
                  <td>
                    <span class="shopping-cart__subtotal">$297</span>
                  </td>
                  <td>
                    <a href="#" class="remove-cart">
                      <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                        <path d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                      </svg>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="shopping-cart__product-item">
                      <img loading="lazy" src="../images/cart-item-3.html" width="120" height="120" alt="" />
                    </div>
                  </td>
                  <td>
                    <div class="shopping-cart__product-item__detail">
                      <h4>Cobleknit Shawl</h4>
                      <ul class="shopping-cart__product-item__options">
                        <li>Color: Yellow</li>
                        <li>Size: L</li>
                      </ul>
                    </div>
                  </td>
                  <td>
                    <span class="shopping-cart__product-price">$99</span>
                  </td>
                  <td>
                    <div class="qty-control position-relative">
                      <input type="number" name="quantity" value="3" min="1"
                        class="qty-control__number text-center">
                      <div class="qty-control__reduce">-</div>
                      <div class="qty-control__increase">+</div>
                    </div><!-- .qty-control -->
                  </td>
                  <td>
                    <span class="shopping-cart__subtotal">$297</span>
                  </td>
                  <td>
                    <a href="#" class="remove-cart">
                      <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                        <path d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                      </svg>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="cart-table-footer">
              <button class="btn btn-light">DELETE ALL WISHLIST</button>
            </div>
          </div>
        </div>
      @else
        <div class="alert alert-warning mt-4 mb-4 text-center" role="alert">
          Anda harus <strong>login</strong> terlebih dahulu untuk melihat dan mengelola wishlist Anda.
        </div>
        <div class="text-center">
          <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        </div>
      @endauth
    </section>
  </main>
@endsection
