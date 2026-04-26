@extends('layouts.admin')

@section('content')
  <div class="main-content-inner">
    <div class="main-content-wrap">
      <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Edit Category</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
          <li>
            <a href="#">
              <div class="text-tiny">Dashboard</div>
            </a>
          </li>
          <li>
            <i class="icon-chevron-right"></i>
          </li>
          <li>
            <a href="#">
              <div class="text-tiny">Categories</div>
            </a>
          </li>
          <li>
            <i class="icon-chevron-right"></i>
          </li>
          <li>
            <div class="text-tiny">Update Categories</div>
          </li>
        </ul>
      </div>

      <div class="wg-box">
        <form class="form-new-product form-style-1" action="{{ route('admin.categories.update', $category->id) }}"
          method="POST" enctype="multipart/form-data">
          @method('patch')
          @csrf
          <fieldset class="name">
            <div class="body-title">Category Name <span class="tf-color-1">*</span></div>
            <input class="flex-grow" type="text" placeholder="Category name" name="name" tabindex="0"
              value="{{ old('name', $category->name) }}">
          </fieldset>
          @error('name')
            <div class="text-danger text-xs mt-1">{{ $message }}</div>
          @enderror
          <fieldset>
            <div class="body-title">Upload images <span class="tf-color-1">*</span>
            </div>
            <div class="upload-image flex-grow">
              <div class="item" id="imgpreview"
                style="display:{{ old('image') || $category->image || $errors->has('image') ? 'block' : 'none' }}">
                <img id="preview-image"
                  src="{{ old('image') ? '' : ($category->image ? asset('storage/' . $category->image) : '') }}"
                  class="effect8" alt="">
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
          <div class="bot">
            <div></div>
            <button class="tf-button w208" type="submit">Save</button>
          </div>
        </form>
      </div>
    </div>
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
    </script>
  @endpush
@endsection
