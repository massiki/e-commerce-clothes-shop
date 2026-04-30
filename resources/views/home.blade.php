@extends('layouts.app')

@section('content')
  <main>
    {{-- slider --}}
    <section class="swiper-container js-swiper-slider swiper-number-pagination slideshow"
      data-settings='{
        "autoplay": {
          "delay": 5000
        },
        "slidesPerView": 1,
        "effect": "fade",
        "loop": true
      }'>
      <div class="swiper-wrapper">
        @foreach ($sliders as $slider)
          <div class="swiper-slide">
            <div class="overflow-hidden position-relative h-100">
              <div class="slideshow-character position-absolute bottom-0 pos_right-center">
                <img loading="lazy" src="{{ asset('storage/' . $slider->image) }}" width="542" height="733"
                  alt="{{ $slider->title }}"
                  class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto" />
                <div class="character_markup type2">
                  <p
                    class="text-uppercase font-sofia mark-grey-color animate animate_fade animate_btt animate_delay-10 mb-0">
                    {{ $slider->subtitle }}</p>
                </div>
              </div>
              <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
                <h6 class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                  {{ $slider->tagline }}</h6>
                <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">{{ $slider->title }}</h2>
                <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">{{ $slider->subtitle }}
                </h2>
                <a href="{{ $slider->link }}"
                  class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop
                  Now</a>
              </div>
            </div>
          </div>
        @endforeach

        {{-- <div class="swiper-slide">
          <div class="overflow-hidden position-relative h-100">
            <div class="slideshow-character position-absolute bottom-0 pos_right-center">
              <img loading="lazy" src="assets/images/slideshow-character1.png" width="400" height="733"
                alt="Woman Fashion 1"
                class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto" />
              <div class="character_markup">
                <p class="text-uppercase font-sofia fw-bold animate animate_fade animate_rtl animate_delay-10">Summer
                </p>
              </div>
            </div>
            <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
              <h6 class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                New Arrivals</h6>
              <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">Night Spring</h2>
              <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">Dresses</h2>
              <a href="#"
                class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop
                Now</a>
            </div>
          </div>
        </div>

        <div class="swiper-slide">
          <div class="overflow-hidden position-relative h-100">
            <div class="slideshow-character position-absolute bottom-0 pos_right-center">
              <img loading="lazy" src="assets/images/slideshow-character2.png" width="400" height="690"
                alt="Woman Fashion 2"
                class="slideshow-character__img animate animate_fade animate_rtl animate_delay-10 w-auto h-auto" />
            </div>
            <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
              <h6 class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                New Arrivals</h6>
              <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">Night Spring</h2>
              <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">Dresses</h2>
              <a href="#"
                class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop
                Now</a>
            </div>
          </div>
        </div> --}}
      </div>
      <div class="container">
        <div
          class="slideshow-pagination slideshow-number-pagination d-flex align-items-center position-absolute bottom-0 mb-5">
        </div>
      </div>
    </section>
    {{-- end slider --}}

    <div class="container mw-1620 bg-white border-radius-10">
      <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>
      {{-- show 8 category --}}
      <section class="category-carousel container">
        <h2 class="section-title text-center mb-3 pb-xl-2 mb-xl-4">You Might Like</h2>
        <div class="position-relative">
          <div class="swiper-container js-swiper-slider"
            data-settings='{
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": 8,
              "slidesPerGroup": 1,
              "effect": "none",
              "loop": true,
              "navigation": {
                "nextEl": ".products-carousel__next-1",
                "prevEl": ".products-carousel__prev-1"
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "slidesPerGroup": 2,
                  "spaceBetween": 15
                },
                "768": {
                  "slidesPerView": 4,
                  "slidesPerGroup": 4,
                  "spaceBetween": 30
                },
                "992": {
                  "slidesPerView": 6,
                  "slidesPerGroup": 1,
                  "spaceBetween": 45,
                  "pagination": false
                },
                "1200": {
                  "slidesPerView": 8,
                  "slidesPerGroup": 1,
                  "spaceBetween": 60,
                  "pagination": false
                }
              }
            }'>
            <div class="swiper-wrapper">
              @foreach ($categories as $category)
                <div class="swiper-slide">
                  <img loading="lazy" class="w-100 h-auto mb-3" src="{{ asset('storage/' . $category->image) }}"
                    width="124" height="124" alt="" />
                  <div class="text-center">
                    <a href="{{ url('shop') }}?category={{ $category->slug }}"
                      class="menu-link fw-medium">{{ $category->name }}</a>
                  </div>
                </div>
              @endforeach
            </div><!-- /.swiper-wrapper -->
          </div><!-- /.swiper-container js-swiper-slider -->

          <div
            class="products-carousel__prev products-carousel__prev-1 position-absolute top-50 d-flex align-items-center justify-content-center">
            <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_prev_md" />
            </svg>
          </div><!-- /.products-carousel__prev -->
          <div
            class="products-carousel__next products-carousel__next-1 position-absolute top-50 d-flex align-items-center justify-content-center">
            <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_next_md" />
            </svg>
          </div><!-- /.products-carousel__next -->
        </div><!-- /.position-relative -->
      </section>
      {{-- end show 8 category --}}

      <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

      {{-- show 8 sale product --}}
      <section class="hot-deals container">
        <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4">Hot Deals</h2>
        <div class="row">
          <div
            class="col-md-6 col-lg-4 col-xl-20per d-flex align-items-center flex-column justify-content-center py-4 align-items-md-start">
            <h2>Summer Sale</h2>
            <h2 class="fw-bold">Up to 60% Off</h2>

            {{-- countdown --}}
            <div class="position-relative d-flex align-items-center text-center pt-xxl-4 js-countdown mb-3"
              data-date="18-3-2027" data-time="06:50">
              <div class="day countdown-unit">
                <span class="countdown-num d-block"></span>
                <span class="countdown-word text-uppercase text-secondary">Days</span>
              </div>

              <div class="hour countdown-unit">
                <span class="countdown-num d-block"></span>
                <span class="countdown-word text-uppercase text-secondary">Hours</span>
              </div>

              <div class="min countdown-unit">
                <span class="countdown-num d-block"></span>
                <span class="countdown-word text-uppercase text-secondary">Mins</span>
              </div>

              <div class="sec countdown-unit">
                <span class="countdown-num d-block"></span>
                <span class="countdown-word text-uppercase text-secondary">Sec</span>
              </div>
            </div>
            {{-- end countdown --}}

            <a href="{{ route('shop') }}" class="btn-link default-underline text-uppercase fw-medium mt-3">View All</a>
          </div>
          <div class="col-md-6 col-lg-8 col-xl-80per">
            <div class="position-relative">
              <div class="swiper-container js-swiper-slider"
                data-settings='{
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": 4,
                  "slidesPerGroup": 4,
                  "effect": "none",
                  "loop": false,
                  "breakpoints": {
                    "320": {
                      "slidesPerView": 2,
                      "slidesPerGroup": 2,
                      "spaceBetween": 14
                    },
                    "768": {
                      "slidesPerView": 2,
                      "slidesPerGroup": 3,
                      "spaceBetween": 24
                    },
                    "992": {
                      "slidesPerView": 3,
                      "slidesPerGroup": 1,
                      "spaceBetween": 30,
                      "pagination": false
                    },
                    "1200": {
                      "slidesPerView": 4,
                      "slidesPerGroup": 1,
                      "spaceBetween": 30,
                      "pagination": false
                    }
                  }
                }'>
                <div class="swiper-wrapper">
                  @foreach ($saleProducts as $product)
                    <div class="swiper-slide product-card product-card_style3">
                      <div class="pc__img-wrapper">
                        <a href="{{ route('shop-detail', $product->slug) }}">
                          <img loading="lazy" src="{{ asset('storage/' . $product->image) }}" width="258"
                            height="313" alt="{{ $product->name }}" class="pc__img">
                        </a>
                        @if (\Carbon\Carbon::parse($product->created_at)->gt(\Carbon\Carbon::now()->subWeeks(2)))
                          <div class="product-label text-uppercase bg-white top-0 left-0 mt-2 mx-2">New</div>
                        @endif
                      </div>

                      <div class="pc__info position-relative">
                        <h6 class="pc__title">
                          <a href="{{ route('shop-detail', $product->slug) }}">{{ $product->name }}</a>
                        </h6>
                        <div class="product-card__price d-flex align-items-center">
                          <span class="money price-old" @if (!$product->sale_price) style="display:none;" @endif>
                            @if ($product->sale_price)
                              Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                            @endif
                          </span>
                          <span class="money price price-sale">
                            Rp {{ number_format($product->sale_price ?? $product->regular_price, 0, ',', '.') }}
                          </span>
                        </div>

                        <div
                          class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body">
                          <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside"
                            data-aside="cartDrawer" title="Add To Cart"
                            onclick="event.preventDefault(); document.getElementById('cart-add-sale-{{ $product->id }}').submit();">
                            Add To Cart
                          </button>
                          <form action="{{ route('shop-detail', $product->slug) }}">
                            <button type="submit"
                              class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view"
                              data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                              <span class="d-none d-xxl-block">Quick View</span>
                              <span class="d-block d-xxl-none">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <use href="#icon_view" />
                                </svg>
                              </span>
                            </button>
                          </form>
                          @php
                            $isThereWistlist = optional($product->wishlists->first())->product_id == $product->id;
                          @endphp
                          <form
                            action="{{ $isThereWistlist ? route('user.wishlist.destroy', $product->wishlists->first()->id) : route('user.wishlist') }}"
                            method="post" style="margin: 0;">
                            @if ($isThereWistlist)
                              @method('DELETE')
                            @endif
                            @csrf
                            <input type="hidden" name="productId" value="{{ $product->id }}">
                            <button type="submit" class="pc__btn-wl bg-transparent border-0 js-add-wishlist"
                              title="Add To Wishlist">
                              <i class="fa fa-heart{{ $isThereWistlist ? ' text-red' : '-o' }}"></i>
                            </button>
                          </form>
                          <form action="{{ route('user.cart.add') }}" method="POST"
                            id="cart-add-sale-{{ $product->id }}" style="display: none;">
                            @csrf
                            <input type="hidden" name="productId" value="{{ $product->id }}">
                          </form>
                        </div>
                      </div>
                    </div>
                  @endforeach


                </div><!-- /.swiper-wrapper -->
              </div><!-- /.swiper-container js-swiper-slider -->
            </div><!-- /.position-relative -->
          </div>
        </div>
      </section>
      {{-- end show 8 sale product --}}

      <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

      {{-- show 2 sale product --}}
      <section class="category-banner container">
        <div class="row">
          <div class="col-md-6">
            <div class="category-banner__item border-radius-10 mb-5">
              <img loading="lazy" class="h-auto" src="assets/images/home/demo3/category_9.jpg" width="690"
                height="665" alt="" />
              <div class="category-banner__item-mark">
                Starting at $19
              </div>
              <div class="category-banner__item-content">
                <h3 class="mb-0">Blazers</h3>
                <a href="#" class="btn-link default-underline text-uppercase fw-medium">Shop Now</a>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="category-banner__item border-radius-10 mb-5">
              <img loading="lazy" class="h-auto" src="assets/images/home/demo3/category_10.jpg" width="690"
                height="665" alt="" />
              <div class="category-banner__item-mark">
                Starting at $19
              </div>
              <div class="category-banner__item-content">
                <h3 class="mb-0">Sportswear</h3>
                <a href="#" class="btn-link default-underline text-uppercase fw-medium">Shop Now</a>
              </div>
            </div>
          </div>
        </div>
      </section>
      {{-- end show 2 sale product --}}

      <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

      {{-- show 8 product featured --}}
      <section class="products-grid container">
        <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4">Featured Products</h2>

        <div class="row">
          @foreach ($featuredProducts as $product)
            <div class="col-6 col-md-4 col-lg-3">
              <div class="product-card product-card_style3 mb-3 mb-md-4 mb-xxl-5">
                <div class="pc__img-wrapper">
                  <a href="{{ route('shop-detail', $product->slug) }}">
                    <img loading="lazy" src="{{ asset('storage/' . $product->image) }}" width="330" height="400"
                      alt="Cropped Faux leather Jacket" class="pc__img">
                  </a>
                  @if (\Carbon\Carbon::parse($product->created_at)->gt(\Carbon\Carbon::now()->subWeeks(2)))
                    <div class="product-label text-uppercase bg-white top-0 left-0 mt-2 mx-2">New</div>
                  @endif
                </div>

                <div class="pc__info position-relative">
                  <h6 class="pc__title"><a href="{{ route('shop-detail', $product->slug) }}">{{ $product->name }}</a>
                  </h6>
                  <div class="product-card__price d-flex align-items-center">
                    @if ($product->sale_price)
                      <span class="money price-old">
                        Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                      </span>
                      <span class="money price price-sale">Rp
                        {{ number_format($product->sale_price, 0, ',', '.') }}
                      </span>
                    @else
                      <span class="money price">
                        Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                      </span>
                    @endif
                  </div>

                  <div
                    class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body">
                    <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside"
                      data-aside="cartDrawer" title="Add To Cart"
                      onclick="event.preventDefault(); document.getElementById('cart-add-{{ $product->id }}').submit();">
                      Add To Cart
                    </button>
                    <form action="{{ route('shop-detail', $product->slug) }}">
                      <button type="submit" class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view"
                        data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                        <span class="d-none d-xxl-block">Quick View</span>
                        <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_view" />
                          </svg></span>
                      </button>
                    </form>
                    @php
                      $isThereWistlist = optional($product->wishlists->first())->product_id == $product->id;
                    @endphp
                    <form
                      action="{{ $isThereWistlist ? route('user.wishlist.destroy', $product->wishlists->first()->id) : route('user.wishlist') }}"
                      method="post">
                      @if ($isThereWistlist)
                        @method('DELETE')
                      @endif
                      @csrf
                      <input type="hidden" name="productId" value="{{ $product->id }}">
                      <button type="submit" class="pc__btn-wl bg-transparent border-0 js-add-wishlist"
                        title="Add To Wishlist">
                        <i class="fa fa-heart{{ $isThereWistlist ? ' text-red' : '-o' }}"></i>
                      </button>
                    </form>
                    <form action="{{ route('user.cart.add') }}" method="POST" id="cart-add-{{ $product->id }}"
                      style="display: none;">
                      @csrf
                      <input type="text" name="productId" value="{{ $product->id }}">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div><!-- /.row -->

        <div class="text-center mt-2">
          <a class="btn-link btn-link_lg default-underline text-uppercase fw-medium" href="{{ route('shop') }}">Load
            More</a>
        </div>
      </section>
      {{-- end show 8 product featured --}}
    </div>

    <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

  </main>
@endsection
