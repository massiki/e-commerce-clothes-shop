<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  {{-- <link rel="dns-prefetch" href="//fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}

  <meta name="author" content="clothes shop" />
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.gstatic.com/">
  <link
    href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Allura&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper.min.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
  <style>
    .pt-90 {
      padding-top: 90px !important;
    }

    .pr-6px {
      padding-right: 6px;
      text-transform: uppercase;
    }

    .my-account .page-title {
      font-size: 1.5rem;
      font-weight: 700;
      text-transform: uppercase;
      margin-bottom: 40px;
      border-bottom: 1px solid;
      padding-bottom: 13px;
    }

    .my-account .wg-box {
      display: -webkit-box;
      display: -moz-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      padding: 24px;
      flex-direction: column;
      gap: 24px;
      border-radius: 12px;
      background: var(--White);
      box-shadow: 0px 4px 24px 2px rgba(20, 25, 38, 0.05);
    }

    .bg-success {
      background-color: #40c710 !important;
    }

    .bg-danger {
      background-color: #f44032 !important;
    }

    .bg-warning {
      background-color: #f5d700 !important;
      color: #000;
    }

    .table-transaction>tbody>tr:nth-of-type(odd) {
      --bs-table-accent-bg: #fff !important;

    }

    .table-transaction th,
    .table-transaction td {
      padding: 0.625rem 1.5rem .25rem !important;
      color: #000 !important;
    }

    .table> :not(caption)>tr>th {
      padding: 0.625rem 1.5rem .25rem !important;
      background-color: #6a6e51 !important;
    }

    .table-bordered>:not(caption)>*>* {
      border-width: inherit;
      line-height: 32px;
      font-size: 14px;
      border: 1px solid #e1e1e1;
      vertical-align: middle;
    }

    .table-striped .image {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 50px;
      height: 50px;
      flex-shrink: 0;
      border-radius: 10px;
      overflow: hidden;
    }

    .table-striped td:nth-child(1) {
      min-width: 250px;
      padding-bottom: 7px;
    }

    .pname {
      display: flex;
      gap: 13px;
    }

    .table-bordered> :not(caption)>tr>th,
    .table-bordered> :not(caption)>tr>td {
      border-width: 1px 1px;
      border-color: #6a6e51;
    }
  </style>
  <!-- Scripts -->
  {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
  @stack('styles')
</head>

<body class="gradient-bg">
  @include('components.nav-app')

  @yield('content')

  <hr class="mt-5 text-secondary" />
  @include('components.footer-app')

  @include('components.footer-mobile-app')

  <div id="scrollTop" class="visually-hidden end-0"></div>
  <div class="page-overlay"></div>

  <script src="{{ asset('assets/js/plugins/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/bootstrap-slider.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/swiper.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/countdown.js') }}"></script>
  <script src="{{ asset('assets/js/theme.js') }}"></script>
  @stack('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // desktop
      let inputSearch = document.getElementById('search-product')
      let resultBox = document.getElementById('search-result')
      let timeout;
      inputSearch.addEventListener('input', (event) => {
        let keyword = event.target.value;
        clearTimeout(timeout);
        timeout = setTimeout(() => {
          if (keyword.trim() === "") {
            resultBox.innerHTML = "";
            return;
          }
          fetch(`{{ url('search-product') }}?search=${encodeURIComponent(keyword)}`)
            .then(res => res.json())
            .then(data => {
              let products = data.product || [];
              let html = '';
              if (products.length > 0) {
                html = products.map(product => `
                  <li class="sub-menu__item d-flex align-items-center gap-3 bg-white rounded-2 shadow-sm p-2 mb-2" style="min-width: 220px;">
                    <div class="d-flex align-items-center justify-content-center bg-light border rounded-1 flex-shrink-0"
                      style="width: 48px; height: 48px; overflow: hidden;">
                      <img src="${'{{ asset('storage/') }}/' + product.image }" alt="${product.name}" class="img-fluid"
                        style="max-width:100%; max-height:100%; object-fit:cover;">
                    </div>
                    <a href="{{ url('shop') }}/${product.slug}" class="menu-link menu-link_us-s fw-medium text-dark text-decoration-none">${product.name}</a>
                  </li>
                `).join('');
              } else {
                html = `<li class="sub-menu__item text-center w-100 p-2">No products found</li>`;
              }
              resultBox.innerHTML = html;
            })
            .catch(error => {
              resultBox.innerHTML =
                `<li class="sub-menu__item text-center w-100 p-2">Error fetching products</li>`;
              console.log('gagal mengambil data', error);
            });
        }, 500);
      });
      // end desktop

      // mobile
      let inputSearchMobile = document.getElementById('search-product-mobile')
      let resultBoxMobile = document.getElementById('search-result-mobile')
      let timeoutMobile;
      inputSearchMobile.addEventListener('input', (event) => {
        let keyword = event.target.value;
        clearTimeout(timeoutMobile);
        timeoutMobile = setTimeout(() => {
          if (keyword.trim() === "") {
            resultBoxMobile.innerHTML = "";
            return;
          }
          fetch(`{{ url('search-product') }}?search=${encodeURIComponent(keyword)}`)
            .then(res => res.json())
            .then(data => {
              let products = data.product || [];
              let html = '';
              if (products.length > 0) {
                html = products.map(product => `
                  <li class="sub-menu__item d-flex align-items-center gap-3 bg-white rounded-2 shadow-sm p-2 mb-2" style="min-width: 220px;">
                    <div class="d-flex align-items-center justify-content-center bg-light border rounded-1 flex-shrink-0"
                      style="width: 48px; height: 48px; overflow: hidden;">
                      <img src="${'{{ asset('storage/') }}/' + product.image }" alt="${product.name}" class="img-fluid"
                        style="max-width:100%; max-height:100%; object-fit:cover;">
                    </div>
                    <a href="{{ url('shop') }}/${product.slug}" class="menu-link menu-link_us-s fw-medium text-dark text-decoration-none">${product.name}</a>
                  </li>
                `).join('');
              } else {
                html = `<li class="sub-menu__item text-center w-100 p-2">No products found</li>`;
              }
              resultBoxMobile.innerHTML = html;
            })
            .catch(error => {
              resultBoxMobile.innerHTML =
                `<li class="sub-menu__item text-center w-100 p-2">Error fetching products</li>`;
              console.log('gagal mengambil data', error);
            });
        }, 500);
      });
      // end mobile
    });
  </script>
</body>

</html>
