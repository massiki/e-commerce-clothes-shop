<footer class="footer footer_type_2">
  <div class="footer-middle container">
    <div class="row row-cols-lg-5 row-cols-2">
      <div class="footer-column footer-store-info col-12 mb-4 mb-lg-0">
        <div class="logo">
          <a href="index.html">
            <img src="{{ asset('assets/images/logo.png') }}" alt="SurfsideMedia" class="logo__image d-block" />
          </a>
        </div>
        <p class="footer-address">123 Beach Avenue, Surfside City, CA 00000</p>
        <p class="m-0"><strong class="fw-medium">contact@surfsidemedia.in</strong></p>
        <p><strong class="fw-medium">+1 000-000-0000</strong></p>

        <ul class="social-links list-unstyled d-flex flex-wrap mb-0">
          <li>
            <a href="#" class="footer__social-link d-block">
              <svg class="svg-icon svg-icon_facebook" width="9" height="15" viewBox="0 0 9 15"
                xmlns="http://www.w3.org/2000/svg">
                <use href="#icon_facebook" />
              </svg>
            </a>
          </li>
          <li>
            <a href="#" class="footer__social-link d-block">
              <svg class="svg-icon svg-icon_twitter" width="14" height="13" viewBox="0 0 14 13"
                xmlns="http://www.w3.org/2000/svg">
                <use href="#icon_twitter" />
              </svg>
            </a>
          </li>
          <li>
            <a href="#" class="footer__social-link d-block">
              <svg class="svg-icon svg-icon_instagram" width="14" height="13" viewBox="0 0 14 13"
                xmlns="http://www.w3.org/2000/svg">
                <use href="#icon_instagram" />
              </svg>
            </a>
          </li>
          <li>
            <a href="#" class="footer__social-link d-block">
              <svg class="svg-icon svg-icon_youtube" width="16" height="11" viewBox="0 0 16 11"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M15.0117 1.8584C14.8477 1.20215 14.3281 0.682617 13.6992 0.518555C12.5234 0.19043 7.875 0.19043 7.875 0.19043C7.875 0.19043 3.19922 0.19043 2.02344 0.518555C1.39453 0.682617 0.875 1.20215 0.710938 1.8584C0.382812 3.00684 0.382812 5.46777 0.382812 5.46777C0.382812 5.46777 0.382812 7.90137 0.710938 9.07715C0.875 9.7334 1.39453 10.2256 2.02344 10.3896C3.19922 10.6904 7.875 10.6904 7.875 10.6904C7.875 10.6904 12.5234 10.6904 13.6992 10.3896C14.3281 10.2256 14.8477 9.7334 15.0117 9.07715C15.3398 7.90137 15.3398 5.46777 15.3398 5.46777C15.3398 5.46777 15.3398 3.00684 15.0117 1.8584ZM6.34375 7.68262V3.25293L10.2266 5.46777L6.34375 7.68262Z" />
              </svg>
            </a>
          </li>
          <li>
            <a href="#" class="footer__social-link d-block">
              <svg class="svg-icon svg-icon_pinterest" width="14" height="15" viewBox="0 0 14 15"
                xmlns="http://www.w3.org/2000/svg">
                <use href="#icon_pinterest" />
              </svg>
            </a>
          </li>
        </ul>
      </div>

      @php
        $products = \App\Models\Product::inRandomOrder()->take(5)->get();
        $categories = \App\Models\Category::inRandomOrder()->take(5)->get();
      @endphp

      {{-- company --}}
      <x-link-menu-footer-user title="Company">
        @include('components.link-footer-user', ['title' => 'About Us'])
        @include('components.link-footer-user', ['title' => 'Careers'])
        @include('components.link-footer-user', ['title' => 'Affiliates'])
        @include('components.link-footer-user', ['title' => 'Blog'])
        @include('components.link-footer-user', [
            'title' => 'Contact Us',
            'href' => route('contact.index'),
        ])
      </x-link-menu-footer-user>
      {{-- end company --}}

      {{-- products --}}
      <x-link-menu-footer-user title="Products">
        @foreach ($products as $product)
          @include('components.link-footer-user', [
              'title' => $product->name,
              'href' => route('shop-detail', $product->slug),
          ])
        @endforeach
      </x-link-menu-footer-user>
      {{-- end products --}}

      {{-- Help --}}
      <x-link-menu-footer-user title="Help">
        @include('components.link-footer-user', ['title' => 'Customer Service'])
        @include('components.link-footer-user', ['title' => 'My Account'])
        @include('components.link-footer-user', ['title' => 'Find a Store'])
        @include('components.link-footer-user', ['title' => 'Legal & Privacy'])
        @include('components.link-footer-user', ['title' => 'Gift Card'])

      </x-link-menu-footer-user>
      {{-- end Help --}}

      {{-- categories --}}
      <x-link-menu-footer-user title="Categories">
        @foreach ($categories as $category)
          @include('components.link-footer-user', [
              'title' => $category->name,
              'href' => route('shop', ['category' => $category->slug]),
          ])
        @endforeach
      </x-link-menu-footer-user>
      {{-- end cateogories --}}
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container d-md-flex align-items-center">
      <span class="footer-copyright me-auto">©2024 Surfside Media</span>
      <div class="footer-settings d-md-flex align-items-center">
        <a href="privacy-policy.html">Privacy Policy</a> &nbsp;|&nbsp; <a href="terms-conditions.html">Terms &amp;
          Conditions</a>
      </div>
    </div>
  </div>
</footer>
