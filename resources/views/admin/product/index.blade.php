@extends('layouts.admin')

@section('content')
  <div class="main-content-inner">
    <div class="main-content-wrap">
      <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>All Products</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
          <li>
            <a href="index.html">
              <div class="text-tiny">Dashboard</div>
            </a>
          </li>
          <li>
            <i class="icon-chevron-right"></i>
          </li>
          <li>
            <div class="text-tiny">All Products</div>
          </li>
        </ul>
      </div>

      <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
          <div class="wg-filter flex-grow">
            <form class="form-search">
              <fieldset class="name">
                <input type="text" placeholder="Search here..." class="" name="name" tabindex="2"
                  value="" aria-required="true" required="">
              </fieldset>
              <div class="button-submit">
                <button class="" type="submit"><i class="icon-search"></i></button>
              </div>
            </form>
          </div>
          <a class="tf-button style-1 w208" href="{{ route('admin.products.create') }}"><i class="icon-plus"></i>Add
            new</a>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>SalePrice</th>
                <th>SKU</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Featured</th>
                <th>Stock</th>
                <th>Quantity</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($products as $product)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td class="pname">
                    <div class="image">
                      @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="image">
                      @else
                        <img src="https://placehold.co/400x400?text=No\nImage" alt="No Image" class="image">
                      @endif
                    </div>
                    <div class="name">
                      <a href="#" class="body-title-2">{{ $product->name }}</a>
                      <div class="text-tiny mt-3">{{ $product->slug }}</div>
                    </div>
                  </td>
                  <td>Rp {{ number_format($product->regular_price, 0, ',', '.') }}</td>
                  <td>
                    @if ($product->sale_price)
                      Rp {{ number_format($product->sale_price, 0, ',', '.') }}
                    @else
                      <span class="text-muted">-</span>
                    @endif
                  </td>
                  <td>{{ $product->SKU }}</td>
                  <td>{{ $product->category ? $product->category->name : '-' }}</td>
                  <td>{{ $product->brand ? $product->brand->name : '-' }}</td>
                  <td>
                    @if ($product->featured)
                      <span class="badge bg-success">Yes</span>
                    @else
                      <span class="badge bg-secondary">No</span>
                    @endif
                  </td>
                  <td>
                    @if ($product->stock_status === 'instock')
                      <span class="badge bg-success">In Stock</span>
                    @else
                      <span class="badge bg-danger">Out of Stock</span>
                    @endif
                  </td>
                  <td>{{ $product->quantity }}</td>
                  <td>
                    <div class="list-icon-function">
                      <a href="#" target="_blank">
                        <div class="item eye">
                          <i class="icon-eye"></i>
                        </div>
                      </a>
                      <a href="{{ route('admin.products.edit', $product->id) }}">
                        <div class="item edit">
                          <i class="icon-edit-3"></i>
                        </div>
                      </a>
                      <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                        style="display:inline-block"
                        onsubmit="return confirm('Are you sure you want to delete this product?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="item text-danger delete"
                          style="border: none; background: transparent; padding: 0;">
                          <i class="icon-trash-2"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="11" class="text-center">Belum ada products</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
          {{ $products->links('pagination::bootstrap-5') }}
        </div>
      </div>
    </div>
  </div>
@endsection
