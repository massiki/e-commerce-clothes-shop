@extends('layouts.admin')

@section('content')
  <div class="main-content-inner">
    <div class="main-content-wrap">
      <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Order Details</h3>
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
            <div class="text-tiny">Order Items</div>
          </li>
        </ul>
      </div>

      <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
          <div class="wg-filter flex-grow">
            <h5>Ordered Items</h5>
          </div>
          <a class="tf-button style-1 w208" href="{{ route('admin.orders.index') }}">Back</a>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Name</th>
                <th class="text-center">Price</th>
                <th class="text-center">Quantity</th>
                <th class="text-center">SKU</th>
                <th class="text-center">Category</th>
                <th class="text-center">Brand</th>
                <th class="text-center">Options</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($order->items as $item)
                <tr>
                  <td class="pname">
                    <div class="image">
                      <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                        class="image">
                    </div>
                    <div class="name">
                      <a href="#" class="body-title-2">{{ $item->product->name }}</a>
                    </div>
                  </td>
                  <td class="text-center">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                  <td class="text-center">{{ $item->quantity }}</td>
                  <td class="text-center">{{ $item->product->SKU }}</td>
                  <td class="text-center">{{ $item->product->category->name }}</td>
                  <td class="text-center">{{ $item->product->brand->name }}</td>
                  <td class="text-center">-</td>
                  <td class="text-center">
                    <div class="list-icon-function view-icon">
                      <div class="item eye">
                        <i class="icon-eye"></i>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

        </div>
      </div>

      <div class="wg-box mt-5">
        <h5>Shipping Address</h5>
        <div class="my-account__address-item col-md-6">
          @php
            $address = $order->user->address;
          @endphp
          <div class="my-account__address-item__detail">
            <p>{{ $address->name }}</p>
            <p>Kelurahan {{ $address->subdistrict }}</p>
            <p>Kec. {{ $address->district }}, Kab. {{ $address->city }}, {{ $address->province }}</p>
            <p>Code Pos: {{ $address->postal_code }}</p>
            <p>Phone: {{ $address->phone }}</p>
            <p>Full Address: {{ $address->full_address }}</p>
            <p>Address Note: {{ $address->address_note }}</p>
            <br>
          </div>
        </div>
      </div>

      <div class="wg-box mt-5">
        <h5>Transactions</h5>
        <table class="table table-striped table-bordered table-transaction">
          <tbody>
            <tr>
              <th>Subtotal</th>
              <td>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
              <th>Tax</th>
              <td>Rp {{ number_format($order->tax, 0, ',', '.') }}</td>
              <th>Discount</th>
              <td>Rp {{ number_format($order->discount, 0, ',', '.') ?? '0' }}</td>
            </tr>
            <tr>
              <th>Total</th>
              <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
              <th>Payment Mode</th>
              <td>{{ $order->transaction->mode }}</td>
              <th>Status</th>
              <td>
                @if ($order->status == 'ordered')
                  <span class="badge bg-warning text-dark">Ordered</span>
                @elseif ($order->status == 'delivered')
                  <span class="badge bg-success">Delivered</span>
                @elseif ($order->status == 'cancelled')
                  <span class="badge bg-danger">Cancelled</span>
                @else
                  <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                @endif
              </td>

            </tr>
            <tr>
              <th>Order Date</th>
              <td>{{ $order->created_at->format('d M Y H:i') }}</td>
              <th>Delivered Date</th>
              <td>{{ $order->delivered_date ? $order->delivered_date->format('d M Y H:i') : '' }}</td>
              <th>Canceled Date</th>
              <td>{{ $order->cancelled_date ? $order->cancelled_date->format('d M Y H:i') : '' }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
