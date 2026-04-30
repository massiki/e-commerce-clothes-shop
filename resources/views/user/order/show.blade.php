@extends('layouts.app')

@section('content')
  <main class="pt-90" style="padding-top: 0px;">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">Order's Details</h2>
      <div class="row">
        <x-sidebar-user />

        <div class="col-lg-10">
          <div class="wg-box mt-5 mb-5">
            <div class="row">
              <div class="col-6">
                <h5>Ordered Details</h5>
              </div>
              <div class="col-6 text-right">
                <a class="btn btn-sm btn-danger" href="{{ route('user.orders.index') }}">Back</a>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-transaction">
                <tbody>
                  <tr>
                    <th>Order No</th>
                    <td>{{ $order->id }}</td>
                    <th>Phone</th>
                    <td>{{ $order->phone }}</td>
                    <th>Shipping Cost</th>
                    <td>Rp {{ $order->shipping_cost }}</td>
                  </tr>
                  <tr>
                    <th>Order Date</th>
                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                    <th>Delivered Date</th>
                    <td>
                      @if ($order->delivered_date)
                        {{ \Carbon\Carbon::parse($order->delivered_date)->format('d M Y') }}
                      @else
                        -
                      @endif
                    </td>
                    <th>Canceled Date</th>
                    <td>
                      @if ($order->cancelled_date)
                        {{ \Carbon\Carbon::parse($order->cancelled_date)->format('d M Y') }}
                      @else
                        -
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <th>Order Status</th>
                    <td colspan="5">
                      @if ($order->status == 'delivered')
                        <span class="badge bg-success">{{ $order->status }}</span>
                      @elseif($order->status == 'ordered')
                        <span class="badge bg-warning">{{ $order->status }}</span>
                      @elseif($order->status == 'cancelled')
                        <span class="badge bg-danger">{{ $order->status }}</span>
                      @else
                        <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                      @endif
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="wg-box wg-table table-all-user">
            <div class="row">
              <div class="col-6">
                <h5>Ordered Items</h5>
              </div>
              <div class="col-6 text-right">
              </div>
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
                            class="image" style="width:50px;">
                        </div>
                        <div class="name">
                          <a href="{{ route('shop-detail', $item->product->slug) }}" target="_blank"
                            class="body-title-2">{{ $item->product->name }}</a>
                        </div>
                      </td>
                      <td class="text-center">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                      <td class="text-center">{{ $item->quantity }}</td>
                      <td class="text-center">{{ $item->product->SKU }}</td>
                      <td class="text-center">{{ $item->product->category->name ?? '-' }}</td>
                      <td class="text-center">{{ $item->product->brand->name ?? '-' }}</td>
                      <td class="text-center">{{ $item->options ?? '-' }} </td>
                      <td class="text-center">
                        <a href="{{ route('shop-detail', $item->product->slug) }}" target="_blank">
                          <div class="list-icon-function view-icon">
                            <div class="item eye">
                              <i class="fa fa-eye"></i>
                            </div>
                          </div>
                        </a>
                      </td>
                    </tr>
                  @endforeach
                  @if ($order->items->isEmpty())
                    <tr>
                      <td colspan="9" class="text-center">No items found.</td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
          <div class="divider"></div>
          <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

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
            <div class="table-responsive">
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
                    <td>
                      {{ $order->delivered_date ? \Carbon\Carbon::parse($order->delivered_date)->format('d M Y') : '' }}
                    </td>
                    <th>Canceled Date</th>
                    <td>
                      {{ $order->cancelled_date ? \Carbon\Carbon::parse($order->cancelled_date)->format('d M Y') : '' }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          @if ($order->status == 'ordered')
            <div class="wg-box mt-5 text-right">
              <form action="{{ route('user.order.cancel', $order->id) }}" method="POST">
                @csrf
                @method('patch')
                <button type="submit" class="btn btn-danger">Cancel Order</button>
              </form>
            </div>
          @endif
        </div>

      </div>
    </section>
  </main>
@endsection
