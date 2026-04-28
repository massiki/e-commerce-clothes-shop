@extends('layouts.admin')

@section('content')
  <div class="main-content-inner">
    <div class="main-content-wrap">
      <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Edit Coupon</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
          <li>
            <a href="{{ route('admin.home') }}">
              <div class="text-tiny">Dashboard</div>
            </a>
          </li>
          <li>
            <i class="icon-chevron-right"></i>
          </li>
          <li>
            <a href="{{ route('admin.coupons.index') }}">
              <div class="text-tiny">Coupons</div>
            </a>
          </li>
          <li>
            <i class="icon-chevron-right"></i>
          </li>
          <li>
            <div class="text-tiny">Edit Coupon</div>
          </li>
        </ul>
      </div>
      <div class="wg-box">
        <x-alert-success status="success" />
        <form class="form-new-product form-style-1" method="POST"
          action="{{ route('admin.coupons.update', $coupon->id) }}">
          @csrf
          @method('PUT')
          <fieldset class="name">
            <div class="body-title">Coupon Code <span class="tf-color-1">*</span></div>
            <input class="flex-grow" type="text" placeholder="Coupon Code" name="code" tabindex="0"
              value="{{ old('code', $coupon->code) }}">
          </fieldset>
          @error('code')
            <span class="text-danger text-xs">{{ $message }}</span>
          @enderror

          <fieldset class="category">
            <div class="body-title">Coupon Type <span class="tf-color-1">*</span></div>
            <div class="select flex-grow">
              <select class="" name="type">
                <option value="">Select</option>
                <option value="fixed" @selected(old('type', $coupon->type) == 'fixed')>Fixed</option>
                <option value="percent" @selected(old('type', $coupon->type) == 'percent')>Percent</option>
              </select>
            </div>
          </fieldset>
          @error('type')
            <span class="text-danger text-xs">{{ $message }}</span>
          @enderror

          <fieldset class="name">
            <div class="body-title">Value <span class="tf-color-1">*</span></div>
            <input class="flex-grow" type="number" step="any" placeholder="Coupon Value" name="value"
              tabindex="0" value="{{ old('value', $coupon->value) }}">
          </fieldset>
          @error('value')
            <span class="text-danger text-xs">{{ $message }}</span>
          @enderror

          <fieldset class="name">
            <div class="body-title">Cart Value <span class="tf-color-1">*</span></div>
            <input class="flex-grow" type="number" step="any" placeholder="Cart Value" name="cart_value"
              tabindex="0" value="{{ old('cart_value', $coupon->cart_value) }}">
          </fieldset>
          @error('cart_value')
            <span class="text-danger text-xs">{{ $message }}</span>
          @enderror

          <fieldset class="name">
            <div class="body-title">Expiry Date</div>
            <input class="flex-grow" type="date" placeholder="Expiry Date" name="expiry_date" tabindex="0"
              value="{{ old('expiry_date', is_a($coupon->expiry_date, \Illuminate\Support\Carbon::class) ? $coupon->expiry_date->format('Y-m-d') : $coupon->expiry_date) }}">
          </fieldset>
          @error('expiry_date')
            <span class="text-danger text-xs">{{ $message }}</span>
          @enderror

          <div class="bot">
            <div></div>
            <button class="tf-button w208" type="submit">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
