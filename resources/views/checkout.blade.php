@extends('layouts.app')

@section('content')
  <main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
      <h2 class="page-title">Shipping and Checkout</h2>
      <div class="checkout-steps">
        <a href="javacript:void(0)" class="checkout-steps__item active">
          <span class="checkout-steps__item-number">01</span>
          <span class="checkout-steps__item-title">
            <span>Shopping Bag</span>
            <em>Manage Your Items List</em>
          </span>
        </a>
        <a href="javacript:void(0)" class="checkout-steps__item active">
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

      <form name="checkout-form" action="{{ route('user.order') }}" method="post">
        @csrf
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
                  <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', isset($address) ? $address->name : '') }}">
                  <label for="name">Full Name *</label>
                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" id="phone" name="phone"
                    value="{{ old('phone', isset($address) ? $address->phone : '') }}">
                  <label for="phone">Phone Number *</label>
                  @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" id="province" name="province"
                    value="{{ old('province', isset($address) ? $address->province : '') }}">
                  <label for="province">Province *</label>
                  @error('province')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating mt-3 mb-3">
                  <input type="text" class="form-control" id="city" name="city"
                    value="{{ old('city', isset($address) ? $address->city : '') }}">
                  <label for="city">City *</label>
                  @error('city')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" id="district" name="district"
                    value="{{ old('district', isset($address) ? $address->district : '') }}">
                  <label for="district">District *</label>
                  @error('district')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" id="subdistrict" name="subdistrict"
                    value="{{ old('subdistrict', isset($address) ? $address->subdistrict : '') }}">
                  <label for="subdistrict">Subdistrict *</label>
                  @error('subdistrict')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" id="postal_code" name="postal_code"
                    value="{{ old('postal_code', isset($address) ? $address->postal_code : '') }}">
                  <label for="postal_code">Postal Code *</label>
                  @error('postal_code')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" id="full_address" name="full_address"
                    value="{{ old('full_address', isset($address) ? $address->full_address : '') }}">
                  <label for="full_address">Full Address *</label>
                  @error('full_address')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" id="address_note" name="address_note"
                    value="{{ old('address_note', isset($address) ? $address->address_note : '') }}">
                  <label for="address_note">Address Note *</label>
                  @error('address_note')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
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
                    id="checkout_payment_method_bank_transfer" value="bank_transfer" checked>
                  <label class="form-check-label" for="checkout_payment_method_bank_transfer">
                    Bank Transfer
                    <p class="option-detail">
                      Make your payment directly into our bank account. Please use your Order ID as the payment
                      reference. Your order will not be shipped until the funds have cleared in our account.
                    </p>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="checkout_payment_method"
                    id="checkout_payment_method_ewallet" value="e_wallet">
                  <label class="form-check-label" for="checkout_payment_method_ewallet">
                    E-Wallet
                    <p class="option-detail">
                      Pay easily using popular e-wallets like OVO, Dana, GoPay, and others.
                    </p>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="checkout_payment_method"
                    id="checkout_payment_method_cod" value="cod">
                  <label class="form-check-label" for="checkout_payment_method_cod">
                    Cash on Delivery (COD)
                    <p class="option-detail">
                      Pay with cash upon receiving your order at your doorstep
                    </p>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="checkout_payment_method"
                    id="checkout_payment_method_qris" value="qris">
                  <label class="form-check-label" for="checkout_payment_method_qris">
                    QRIS
                    <p class="option-detail">
                      Pay with QRIS compatible apps by scanning the QR code after order submission.
                    </p>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="checkout_payment_method"
                    id="checkout_payment_method_virtual_account" value="virtual_account">
                  <label class="form-check-label" for="checkout_payment_method_virtual_account">
                    Virtual Account
                    <p class="option-detail">
                      Transfer your payment to a unique virtual account number generated for your order.
                    </p>
                  </label>
                </div>
                <div class="policy-text">
                  Your personal data will be used to process your order, support your experience throughout this
                  website, and for other purposes described in our
                  <a href="#" target="_blank">privacy policy</a>.
                </div>
              </div>

              <button type="submit" class="btn btn-primary btn-checkout">PLACE ORDER</button>
            </div>
          </div>
        </div>
      </form>
    </section>
  </main>
@endsection
