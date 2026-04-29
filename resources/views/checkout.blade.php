@extends('layouts.app')

@section('content')
  <main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
      <h2 class="page-title">Shipping and Checkout</h2>
      <div class="checkout-steps">
        <a href="{{ route('cart') }}" class="checkout-steps__item active">
          <span class="checkout-steps__item-number">01</span>
          <span class="checkout-steps__item-title">
            <span>Shopping Bag</span>
            <em>Manage Your Items List</em>
          </span>
        </a>
        <a href="{{ route('user.checkout') }}" class="checkout-steps__item active">
          <span class="checkout-steps__item-number">02</span>
          <span class="checkout-steps__item-title">
            <span>Shipping and Checkout</span>
            <em>Checkout Your Items List</em>
          </span>
        </a>
        <a href="#" class="checkout-steps__item">
          <span class="checkout-steps__item-number">03</span>
          <span class="checkout-steps__item-title">
            <span>Confirmation</span>
            <em>Review And Submit Your Order</em>
          </span>
        </a>
      </div>

      <form name="checkout-form" action="#">
        <div class="checkout-form">
          {{-- shipping detail --}}
          <div class="billing-info__wrapper">
            <div class="row">
              <div class="col-6">
                <h4>SHIPPING DETAILS</h4>
              </div>
              <div class="col-6">
              </div>
            </div>

            <div class="row mt-5">
              <div class="col-md-6">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="name" required="">
                  <label for="name">Full Name *</label>
                  <span class="text-danger"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="phone" required="">
                  <label for="phone">Phone Number *</label>
                  <span class="text-danger"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="zip" required="">
                  <label for="zip">Pincode *</label>
                  <span class="text-danger"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating mt-3 mb-3">
                  <input type="text" class="form-control" name="state" required="">
                  <label for="state">State *</label>
                  <span class="text-danger"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="city" required="">
                  <label for="city">Town / City *</label>
                  <span class="text-danger"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="address" required="">
                  <label for="address">House no, Building Name *</label>
                  <span class="text-danger"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="locality" required="">
                  <label for="locality">Road Name, Area, Colony *</label>
                  <span class="text-danger"></span>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="landmark" required="">
                  <label for="landmark">Landmark *</label>
                  <span class="text-danger"></span>
                </div>
              </div>
            </div>
          </div>

          {{-- your order --}}
          <div class="checkout__totals-wrapper">
            <div class="sticky-content">
              <div class="checkout__totals">
                <h3>Your Order</h3>
                <table class="checkout-cart-items">
                  <thead>
                    <tr>
                      <th>PRODUCT</th>
                      <th align="right">SUBTOTAL</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($cart->items as $item)
                      <tr>
                        <td>
                          {{ $item->product->name }} x {{ $item->quantity }}
                        </td>
                        <td align="right">
                          @php
                            $price = $item->product->sale_price ?? $item->product->regular_price;
                          @endphp
                          Rp {{ number_format($price * $item->quantity, 0, ',', '.') }}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <table class="checkout-totals">
                  <tbody>
                    @php
                      $subTotal = 0;
                      foreach ($cart->items as $item) {
                          $price = $item->product->sale_price ?? $item->product->regular_price;
                          $subTotal += $price * $item->quantity;
                      }
                    @endphp
                    <tr>
                      <th>SUBTOTAL</th>
                      <td align="right">Rp
                        {{ session()->has('coupon') ? number_format(session('coupon.cart_total'), 0, ',', '.') : number_format($subTotal, 0, ',', '.') }}
                      </td>
                    </tr>
                    @if (session()->has('coupon'))
                      <tr>
                        <th>Discount ({{ session('coupon.code') }})</th>
                        <td align="right">- Rp {{ number_format(session('coupon.discount'), 0, ',', '.') }}</td>
                      </tr>
                    @endif
                    <tr>
                      <th>SHIPPING</th>
                      <td align="right">Free shipping</td>
                    </tr>
                    <tr>
                      <th>VAT</th>
                      <td align="right">Rp 0</td>
                    </tr>
                    <tr>
                      <th>TOTAL</th>
                      <td align="right">Rp
                        {{ session()->has('coupon') ? number_format(session('coupon.final_total'), 0, ',', '.') : number_format($subTotal, 0, ',', '.') }}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="checkout__payment-methods">
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="checkout_payment_method"
                    id="checkout_payment_method_1" checked>
                  <label class="form-check-label" for="checkout_payment_method_1">
                    Bank transfer
                    <p class="option-detail">
                      Make your payment directly into our bank account. Please use your Order ID as the payment
                      reference.Your order will not be shipped until the funds have cleared in our account.
                    </p>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="checkout_payment_method"
                    id="checkout_payment_method_2">
                  <label class="form-check-label" for="checkout_payment_method_2">
                    E_wallet
                    <p class="option-detail">
                      Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum gravida nec dui. Aenean
                      aliquam varius ipsum, non ultricies tellus sodales eu. Donec dignissim viverra nunc, ut aliquet
                      magna posuere eget.
                    </p>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="checkout_payment_method"
                    id="checkout_payment_method_3">
                  <label class="form-check-label" for="checkout_payment_method_3">
                    Cash on delivery (COD)
                    <p class="option-detail">
                      Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum gravida nec dui. Aenean
                      aliquam varius ipsum, non ultricies tellus sodales eu. Donec dignissim viverra nunc, ut aliquet
                      magna posuere eget.
                    </p>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="checkout_payment_method"
                    id="checkout_payment_method_4">
                  <label class="form-check-label" for="checkout_payment_method_4">
                    QRIS
                    <p class="option-detail">
                      Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum gravida nec dui. Aenean
                      aliquam varius ipsum, non ultricies tellus sodales eu. Donec dignissim viverra nunc, ut aliquet
                      magna posuere eget.
                    </p>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="checkout_payment_method"
                    id="checkout_payment_method_4">
                  <label class="form-check-label" for="checkout_payment_method_4">
                    Virtual Account
                    <p class="option-detail">
                      Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum gravida nec dui. Aenean
                      aliquam varius ipsum, non ultricies tellus sodales eu. Donec dignissim viverra nunc, ut aliquet
                      magna posuere eget.
                    </p>
                  </label>
                </div>
                <div class="policy-text">
                  Your personal data will be used to process your order, support your experience throughout this
                  website, and for other purposes described in our
                  <a href="#" target="_blank">privacy policy</a>.
                </div>
              </div>
              <button class="btn btn-primary btn-checkout">PLACE ORDER</button>
            </div>
          </div>
        </div>
      </form>
    </section>
  </main>
@endsection
