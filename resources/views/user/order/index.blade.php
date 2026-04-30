@extends('layouts.app')

@section('content')
  <main class="pt-90" style="padding-top: 0px;">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">Orders</h2>
      <div class="row">
        <x-sidebar-user />

        <div class="col-lg-10">
          <div class="wg-table table-all-user">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="text-center p-0 m-0">#</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center">Subtotal</th>
                    <th class="text-center">Tax</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Order Date</th>
                    <th class="text-center">Items</th>
                    <th class="text-center">Delivered On</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($orders as $order)
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td class="text-center">
                        {{ $order->name }}
                      </td>
                      <td class="text-center">
                        {{ $order->phone }}
                      </td>
                      <td class="text-center">
                        Rp {{ number_format($order->subtotal, 0, ',', '.') }}
                      </td>
                      <td class="text-center">
                        Rp {{ number_format($order->tax, 0, ',', '.') }}
                      </td>
                      <td class="text-center">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                      </td>
                      <td class="text-center">
                        @if ($order->status === 'cancelled')
                          <span class="badge bg-danger">{{ $order->status }}</span>
                        @elseif($order->status === 'delivered')
                          <span class="badge bg-success">{{ $order->status }}</span>
                        @else
                          <span class="badge bg-warning">{{ $order->status }}</span>
                        @endif
                      </td>
                      <td class="text-center">{{ $order->created_at->format('d M Y H:i') }}</td>
                      <td class="text-center">
                        {{ $order->items->count() }}
                      </td>
                      <td class="text-center">
                        {{ $order->delivered_date ?? '' }}
                      </td>
                      <td class="text-center">
                        <a href="{{ route('user.orders.show', $order->id) }}">
                          <div class="list-icon-function view-icon">
                            <div class="item eye">
                              <i class="fa fa-eye"></i>
                            </div>
                          </div>
                        </a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="11" class="text-center">No orders found.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
          <div class="divider"></div>
          <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
            {{ $orders->links('pagination::bootstrap-5') }}
          </div>
        </div>

      </div>
    </section>
  </main>
@endsection
