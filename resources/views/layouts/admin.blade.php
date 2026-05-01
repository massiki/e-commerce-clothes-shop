<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
  <title>{{ config('app.name') }}</title>
  <meta charset="utf-8">
  <meta name="author" content="{{ config('app.name') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/animation.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('font/fonts.css') }}">
  <link rel="stylesheet" href="{{ asset('icon/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('images/logo-fikri.png') }}">
  <link rel="apple-touch-icon-precomposed" href="{{ asset('images/logo-fikri.png') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
</head>

<body class="body">
  <div id="wrapper">
    <div id="page" class="">
      <div class="layout-wrap">

        <!-- <div id="preload" class="preload-container">
    <div class="preloading">
        <span></span>
    </div>
</div> -->

        @include('components.sidebar-admin')
        <div class="section-content-right">
          @include('components.nav-admin')
          <div class="main-content">
            @yield('content')
            <div class="bottom-page">
              <div class="body-text">Copyright © {{ date('Y') }} {{ config('app.name') }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
      document.addEventListener('DOMContentLoaded', () => {
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
                  <li class="product-item gap14 mb-10">
                    <div class="image no-bg">
                      <img src="${'{{ asset('storage/') }}/' + product.image}" alt="${product.name}">
                    </div>
                    <div class="flex items-center justify-between gap20 flex-grow">
                      <div class="name">
                        <a href="{{ url('admin/products') }}/?search=${product.name}" class="body-text">${product.name}</a>
                      </div>
                    </div>
                  </li>
                  <li class="mb-10">
                    <div class="divider"></div>
                  </li>
                `).join('');
                } else {
                  html = `<li class="product-item gap14 mb-10">
                  <div class="name">No products found</div>
                </li>`;
                }
                resultBox.innerHTML = html;
              })
              .catch(error => {
                resultBox.innerHTML = `
                <li class="product-item gap14 mb-10">
                  <div class="name">Error fetching products</div>
                </li>
              `;
                console.log('gagal mengambil data', error);
              });
          }, 500);
        });
      });
    </script>
    <script>
      (function($) {

        var tfLineChart = (function() {

          var chartBar = function() {

            var options = {
              series: [{
                  name: 'Total',
                  data: [0.00, 0.00, 0.00, 0.00, 0.00, 273.22, 208.12, 0.00, 0.00, 0.00, 0.00, 0.00]
                }, {
                  name: 'Pending',
                  data: [0.00, 0.00, 0.00, 0.00, 0.00, 273.22, 208.12, 0.00, 0.00, 0.00, 0.00, 0.00]
                },
                {
                  name: 'Delivered',
                  data: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00]
                }, {
                  name: 'Canceled',
                  data: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00]
                }
              ],
              chart: {
                type: 'bar',
                height: 325,
                toolbar: {
                  show: false,
                },
              },
              plotOptions: {
                bar: {
                  horizontal: false,
                  columnWidth: '10px',
                  endingShape: 'rounded'
                },
              },
              dataLabels: {
                enabled: false
              },
              legend: {
                show: false,
              },
              colors: ['#2377FC', '#FFA500', '#078407', '#FF0000'],
              stroke: {
                show: false,
              },
              xaxis: {
                labels: {
                  style: {
                    colors: '#212529',
                  },
                },
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
              },
              yaxis: {
                show: false,
              },
              fill: {
                opacity: 1
              },
              tooltip: {
                y: {
                  formatter: function(val) {
                    return "$ " + val + ""
                  }
                }
              }
            };

            chart = new ApexCharts(
              document.querySelector("#line-chart-8"),
              options
            );
            if ($("#line-chart-8").length > 0) {
              chart.render();
            }
          };

          /* Function ============ */
          return {
            init: function() {},

            load: function() {
              chartBar();
            },
            resize: function() {},
          };
        })();

        jQuery(document).ready(function() {});

        jQuery(window).on("load", function() {
          tfLineChart.load();
        });

        jQuery(window).on("resize", function() {});
      })(jQuery);
    </script>
    @stack('scripts')
</body>

</html>
