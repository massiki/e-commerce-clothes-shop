@extends('layouts.admin')
@section('content')
  <div class="main-content-inner">
    <!-- main-content-wrap -->
    <div class="main-content-wrap">
      <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Add Product</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
          <li>
            <a href="index-2.html">
              <div class="text-tiny">Dashboard</div>
            </a>
          </li>
          <li>
            <i class="icon-chevron-right"></i>
          </li>
          <li>
            <a href="all-product.html">
              <div class="text-tiny">Products</div>
            </a>
          </li>
          <li>
            <i class="icon-chevron-right"></i>
          </li>
          <li>
            <div class="text-tiny">Add product</div>
          </li>
        </ul>
      </div>
      <!-- form-add-product -->
      <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"
        action="{{ route('admin.products.store') }}">
        @csrf
        <input type="hidden" name="_token" value="8LNRTO4LPXHvbK2vgRcXqMeLgqtqNGjzWSNru7Xx" autocomplete="off">
        <div class="wg-box">
          <fieldset class="name">
            <div class="body-title mb-10">Product name <span class="tf-color-1">*</span>
            </div>
            <input class="mb-10" type="text" placeholder="Enter product name" name="name" tabindex="0"
              value="{{ old('name') }}" aria-required="true" required="">
            <div class="text-tiny">Do not exceed 100 characters when entering the
              product name.</div>
          </fieldset>
          @error('name')
            <div class="text-danger text-xs mt-1">{{ $message }}</div>
          @enderror

          <div class="gap22 cols">
            <fieldset class="category">
              <div class="body-title mb-10">Category <span class="tf-color-1">*</span>
              </div>
              <div class="select">
                <select class="" name="category_id">
                  <option>Choose category</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                      {{ $category->name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </fieldset>
            @error('category_id')
              <div class="text-danger text-xs mt-1">{{ $message }}</div>
            @enderror

            <fieldset class="brand">
              <div class="body-title mb-10">Brand <span class="tf-color-1">*</span>
              </div>
              <div class="select">
                <select class="" name="brand_id">
                  <option>Choose Brand</option>
                  @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" @selected(old('brand_id') == $brand->id)>
                      {{ $brand->name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </fieldset>
            @error('brand_id')
              <div class="text-danger text-xs mt-1">{{ $message }}</div>
            @enderror
          </div>

          <fieldset class="shortdescription">
            <div class="body-title mb-10">Short Description <span class="tf-color-1">*</span></div>
            <textarea class="mb-10 ht-150" name="short_description" placeholder="Short Description" tabindex="0"
              aria-required="true" required="">{{ old('short_description') }}</textarea>
            <div class="text-tiny">Do not exceed 100 characters when entering the
              product name.</div>
          </fieldset>
          @error('short_description')
            <div class="text-danger text-xs mt-1">{{ $message }}</div>
          @enderror

          <fieldset class="description">
            <div class="body-title mb-10">Description <span class="tf-color-1">*</span>
            </div>
            <textarea class="mb-10" name="description" placeholder="Description" tabindex="0" aria-required="true"
              required="">{{ old('description') }}</textarea>
            <div class="text-tiny">Do not exceed 100 characters when entering the
              product name.</div>
          </fieldset>
          @error('description')
            <div class="text-danger text-xs mt-1">{{ $message }}</div>
          @enderror
        </div>
        <div class="wg-box">
          <fieldset>
            <div class="body-title">Upload images <span class="tf-color-1">*</span>
            </div>
            <div class="upload-image flex-grow">
              <div class="item" id="imgpreview"
                style="display:{{ old('image') || $errors->has('image') ? 'block' : 'none' }}">
                <img src="" class="effect8" alt="" id="preview-image">
              </div>
              <div id="upload-file" class="item up-load">
                <label class="uploadfile" for="myFile">
                  <span class="icon">
                    <i class="icon-upload-cloud"></i>
                  </span>
                  <span class="body-text">Drop your images here or select <span class="tf-color">click to
                      browse</span></span>
                  <input type="file" id="myFile" name="image" accept="image/*">
                </label>
              </div>
            </div>
          </fieldset>
          @error('image')
            <div class="text-danger text-xs mt-1">{{ $message }}</div>
          @enderror

          <fieldset>
            <div class="body-title mb-10">Upload Gallery Images</div>
            <div class="upload-image mb-16" id="gallery-preview">
              {{-- <div class="item">
                <img src="#" alt="">
              </div> --}}
              <div id="galUpload" class="item up-load">
                <label class="uploadfile" for="gFile">
                  <span class="icon">
                    <i class="icon-upload-cloud"></i>
                  </span>
                  <span class="text-tiny">Drop your images here or select <span class="tf-color">click to
                      browse</span></span>
                  <input type="file" id="gFile" name="images[]" accept="image/*" multiple="">
                </label>
              </div>
            </div>
          </fieldset>
          @error('images')
            <div class="text-danger text-xs mt-1">{{ $message }}</div>
          @enderror

          <div class="cols gap22">
            <fieldset class="name">
              <div class="body-title mb-10">Regular Price <span class="tf-color-1">*</span></div>
              <input class="mb-10" type="text" placeholder="Enter regular price" name="regular_price"
                tabindex="0" value="{{ old('regular_price') }}" aria-required="true" required="">
            </fieldset>
            @error('regular_price')
              <div class="text-danger text-xs mt-1">{{ $message }}</div>
            @enderror
            <fieldset class="name">
              <div class="body-title mb-10">Sale Price <span class="tf-color-1">*</span></div>
              <input class="mb-10" type="text" placeholder="Enter sale price" name="sale_price" tabindex="0"
                value="{{ old('sale_price') }}">
            </fieldset>
            @error('sale_price')
              <div class="text-danger text-xs mt-1">{{ $message }}</div>
            @enderror
          </div>


          <div class="cols gap22">
            <fieldset class="name">
              <div class="body-title mb-10">SKU <span class="tf-color-1">*</span>
              </div>
              <input class="mb-10" type="text" placeholder="Enter SKU" name="SKU" tabindex="0"
                value="{{ old('SKU') }}" aria-required="true" required="">
            </fieldset>
            @error('SKU')
              <div class="text-danger text-xs mt-1">{{ $message }}</div>
            @enderror
            <fieldset class="name">
              <div class="body-title mb-10">Quantity <span class="tf-color-1">*</span>
              </div>
              <input class="mb-10" type="text" placeholder="Enter quantity" name="quantity" tabindex="0"
                value="{{ old('quantity') }}" aria-required="true" required="">
            </fieldset>
            @error('quantity')
              <div class="text-danger text-xs mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="cols gap22">
            <fieldset class="name">
              <div class="body-title mb-10">Stock</div>
              <div class="select mb-10">
                <select class="" name="stock_status">
                  <option value="instock" @selected(old('stock_status') == 'instock')>InStock</option>
                  <option value="outofstock" @selected(old('stock_status') == 'outofstock')>Out of Stock</option>
                </select>
              </div>
            </fieldset>
            @error('stock_status')
              <div class="text-danger text-xs mt-1">{{ $message }}</div>
            @enderror
            <fieldset class="name">
              <div class="body-title mb-10">Featured</div>
              <div class="select mb-10">
                <select class="" name="featured">
                  <option value="0" @selected(old('featured') == 0)>No</option>
                  <option value="1" @selected(old('featured') == 1)>Yes</option>
                </select>
              </div>
            </fieldset>
            @error('featured')
              <div class="text-danger text-xs mt-1">{{ $message }}</div>
            @enderror
          </div>
          <div class="cols gap10">
            <button class="tf-button w-full" type="submit">Add product</button>
          </div>
        </div>
      </form>
      <!-- /form-add-product -->
    </div>
    <!-- /main-content-wrap -->
  </div>
  @push('scripts')
    <script>
      document.getElementById("myFile").addEventListener("change", function(event) {
        const file = event.target.files[0];

        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            // tampilkan preview container
            document.getElementById("imgpreview").style.display = "block";
            // ubah src image sesuai file upload
            document.getElementById("preview-image").src = e.target.result;
          };
          reader.readAsDataURL(file);
        } else {
          // sembunyikan preview jika tidak ada file
          document.getElementById("imgpreview").style.display = "none";
          document.getElementById("preview-image").src = "";
        }
      });

      document.getElementById('gFile').addEventListener('change', (event) => {
        const files = event.target.files;
        const previewContainer = document.getElementById('gallery-preview');
        const uploadBox = document.getElementById('galUpload');

        // Hapus preview lama (jika ada)
        document.querySelectorAll('.preview-item').forEach(item => {
          item.remove();
        });

        // Jika tidak ada file dipilih
        if (files.length === 0) return;

        // Loop semua file yang dipilih
        Array.from(files).forEach(file => {
          // Validasi hanya image
          if (!file.type.startsWith('image/')) return;

          const reader = new FileReader();

          reader.onload = function(e) {
            // Buat div item baru
            const previewItem = document.createElement('div');
            previewItem.classList.add('item', 'preview-item');

            // Isi gambar preview
            previewItem.innerHTML = `
                <img src="${e.target.result}" alt="Preview Image">
            `;

            // Sisipkan sebelum upload box
            previewContainer.insertBefore(previewItem, uploadBox);
          };

          reader.readAsDataURL(file);
        });
      })
    </script>
  @endpush
@endsection
