@extends('layouts.admin')

@section('content')
  <div class="main-content-inner">
    <!-- main-content-wrap -->
    <div class="main-content-wrap">
      <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Slide</h3>
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
            <a href="{{ route('admin.sliders.index') }}">
              <div class="text-tiny">Slider</div>
            </a>
          </li>
          <li>
            <i class="icon-chevron-right"></i>
          </li>
          <li>
            <div class="text-tiny">New Slide</div>
          </li>
        </ul>
      </div>

      <div class="wg-box">
        <form class="form-new-product form-style-1" method="POST" action="{{ route('admin.sliders.store') }}"
          enctype="multipart/form-data">
          @csrf
          <fieldset class="name">
            <div class="body-title">Tagline <span class="tf-color-1">*</span></div>
            <input class="flex-grow" type="text" placeholder="Tagline" name="tagline" tabindex="1"
              value="{{ old('tagline') }}">
          </fieldset>
          @error('tagline')
            <div class="text-danger text-xs mt-1">{{ $message }}</div>
          @enderror

          <fieldset class="name">
            <div class="body-title">Title <span class="tf-color-1">*</span></div>
            <input class="flex-grow" type="text" placeholder="Title" name="title" tabindex="2"
              value="{{ old('title') }}">
          </fieldset>
          @error('title')
            <div class="text-danger text-xs mt-1">{{ $message }}</div>
          @enderror

          <fieldset class="name">
            <div class="body-title">Subtitle <span class="tf-color-1">*</span></div>
            <input class="flex-grow" type="text" placeholder="Subtitle" name="subtitle" tabindex="3"
              value="{{ old('subtitle') }}">
          </fieldset>
          @error('subtitle')
            <div class="text-danger text-xs mt-1">{{ $message }}</div>
          @enderror

          <fieldset class="name">
            <div class="body-title">Link <span class="tf-color-1">*</span></div>
            <input class="flex-grow" type="text" placeholder="Link (https://...)" name="link" tabindex="4"
              value="{{ old('link') }}">
          </fieldset>
          @error('link')
            <div class="text-danger text-xs mt-1">{{ $message }}</div>
          @enderror

          <fieldset>
            <div class="body-title">Upload image <span class="tf-color-1">*</span></div>
            <div class="upload-image flex-grow">
              <div class="item" id="imgpreview"
                style="display:{{ old('image') || $errors->has('image') ? 'block' : 'none' }}">
                <img src="" class="effect8" alt="" id="preview-image">
              </div>
              <div class="item up-load">
                <label class="uploadfile" for="image">
                  <span class="icon">
                    <i class="icon-upload-cloud"></i>
                  </span>
                  <span class="body-text">Drop your image here or select <span class="tf-color">click to
                      browse</span></span>
                  <input type="file" id="image" name="image">
                </label>
              </div>
            </div>
          </fieldset>
          @error('image')
            <div class="text-danger text-xs mt-1">{{ $message }}</div>
          @enderror

          <div class="bot">
            <div></div>
            <button type="submit" class="tf-button w208">Save</button>
          </div>
        </form>
      </div>
      <!-- /new-category -->
    </div>
    <!-- /main-content-wrap -->
  </div>
  @push('scripts')
    <script>
      document.getElementById("image").addEventListener("change", function(event) {
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
