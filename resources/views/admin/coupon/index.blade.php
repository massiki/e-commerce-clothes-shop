@extends('layouts.admin')

@section('content')
  <div class="main-content-inner">
    <div class="main-content-wrap">

      <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Coupons</h3>
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
            <div class="text-tiny">Coupons</div>
          </li>
        </ul>
      </div>

      <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
          <div class="wg-filter flex-grow">
            <form class="form-search" method="GET" action="{{ route('admin.coupons.index') }}">
              <fieldset class="name">
                <input type="text" placeholder="Search code..." class="" name="search"
                  value="{{ request()->get('search') }}">
              </fieldset>
              <div class="button-submit">
                <button class="" type="submit"><i class="icon-search"></i></button>
              </div>
            </form>
          </div>
          <a class="tf-button style-1 w208" href="{{ route('admin.coupons.create') }}"><i class="icon-plus"></i>Add
            new</a>
        </div>

        {{-- Success Alert --}}
        <x-alert-success status="success" />

        <div class="wg-table table-all-user mt-3">
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Code</th>
                  <th>Type</th>
                  <th>Value</th>
                  <th>Cart Value</th>
                  <th>Expiry Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($coupons as $coupon)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ ucfirst($coupon->type) }}</td>
                    <td>
                      @if ($coupon->type == 'percent')
                        {{ $coupon->value }}%
                      @else
                        Rp. {{ number_format($coupon->value, 0, '.', '.') }}
                      @endif
                    </td>
                    <td>{{ number_format($coupon->cart_value, 0, '.', '.') }}</td>
                    <td>
                      {{ $coupon->expiry_date ? \Carbon\Carbon::parse($coupon->expiry_date)->isoFormat('dddd, D MMMM Y') : '-' }}
                    </td>
                    <td>
                      <div class="list-icon-function">
                        <a href="{{ route('admin.coupons.edit', $coupon->id) }}">
                          <div class="item edit">
                            <i class="icon-edit-3"></i>
                          </div>
                        </a>
                        <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST"
                          style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="bg-transparent border-0 p-0 m-0"
                            onclick="return confirm('Are you sure you want to delete this coupon?');">
                            <div class="item text-danger delete">
                              <i class="icon-trash-2"></i>
                            </div>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7" class="text-center">No coupons found.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
          {{ $coupons->links('pagination::bootstrap-5') }}
        </div>
      </div>
    </div>
  </div>
@endsection
