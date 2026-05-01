<footer class="footer footer_type_2">
  <div class="footer-middle container">
    <div class="row row-cols-lg-5 row-cols-2">
      <div class="footer-column footer-store-info col-12 mb-4 mb-lg-0">
        <div class="logo">
          <a href="javascript:void(0)">
            <img src="{{ asset('images/logo-fikri.png') }}" alt="ShopF" class="logo__image d-block" width="50px" />
          </a>
        </div>
        <p class="footer-address">Kp. Cigadog Rt. 01 Rw. 10, Desa Lingkungpasir, Kec. Cibiuk, Kab. Garut</p>
        <p class="m-0"><strong class="fw-medium">fikri.amrulloh15@gmail.com</strong></p>
        <p class="m-0"><strong class="fw-medium">224260064.mhs@stmikjabar.ac.id</strong></p>
        <p><strong class="fw-medium">+62-852-9453-2451</strong></p>

        <ul class="social-links list-unstyled d-flex flex-wrap mb-0">
          <li>
            <a href="https://www.linkedin.com/in/fikri-amrullah-5583b52b6/" target="_blank"
              class="footer__social-link d-block">
              <i class="fa fa-linkedin"></i>
            </a>
          </li>
          <li>
            <a href="https://wa.me/6285294532451" target="_blank" class="footer__social-link d-block">
              <i class="fa fa-whatsapp"></i>
            </a>
          </li>
          <li>
            <a href="https://www.instagram.com/fikri.amrulloh.15" target="_blank" class="footer__social-link d-block">
              <i class="fa fa-github"></i>
            </a>
          </li>
          <li>
            <a href="https://web.facebook.com/fikri.amrulloh.56" target="_blank" class="footer__social-link d-block">
              <i class="fa fa-facebook"></i>
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
      <span class="footer-copyright me-auto">Copyright © {{ date('Y') }} Fikri Amrullah</span>
      <div class="footer-settings d-md-flex align-items-center">
        <a href="privacy-policy.html">Privacy Policy</a> &nbsp;|&nbsp; <a href="terms-conditions.html">Terms &amp;
          Conditions</a>
      </div>
    </div>
  </div>
</footer>
