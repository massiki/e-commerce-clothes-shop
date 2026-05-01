<div class="header-dashboard">
  <div class="wrap">
    <div class="header-left">
      <a href="#">
        <img class="" id="logo_header_mobile" alt="" src="{{ asset('images/logo-fikri.png') }}"
          data-light="{{ asset('images/logo-fikri.png') }}" data-dark="{{ asset('images/logo-fikri.png') }}"
          data-width="154px" data-height="52px" data-retina="{{ asset('images/logo-fikri.png') }}" width="50px">
      </a>
      <div class="button-show-hide">
        <i class="icon-menu-left"></i>
      </div>

      <form action="javascript:void(0)" class="form-search flex-grow">
        <fieldset class="name">
          <input type="text" placeholder="Search here..." class="show-search" name="name" tabindex="2"
            value="" id="search-product">
        </fieldset>
        <div class="button-submit">
          <button class="" type="submit"><i class="icon-search"></i></button>
        </div>
        <div class="box-content-search" id="box-content-search">
          <ul class="mb-24">
            <li class="mb-14">
              <div class="body-title">Products</div>
            </li>
            <li class="mb-14">
              <div class="divider"></div>
            </li>
            <li>
              <ul id="search-result">
                {{-- <li class="product-item gap14 mb-10">
                  <div class="image no-bg">
                    <img src="{{ asset('images/products/17.png') }}" alt="">
                  </div>
                  <div class="flex items-center justify-between gap20 flex-grow">
                    <div class="name">
                      <a href="{{ asset('product-list.html') }}" class="body-text">Dog Food
                        Rachael Ray Nutrish®</a>
                    </div>
                  </div>
                </li>
                <li class="mb-10">
                  <div class="divider"></div>
                </li> --}}
              </ul>
            </li>
          </ul>
          {{-- <ul class="">
            <li class="mb-14">
              <div class="body-title">Order product</div>
            </li>
            <li class="mb-14">
              <div class="divider"></div>
            </li>
            <li>
              <ul>
                <li class="product-item gap14 mb-10">
                  <div class="image no-bg">
                    <img src="{{ asset('images/products/20.png') }}" alt="">
                  </div>
                  <div class="flex items-center justify-between gap20 flex-grow">
                    <div class="name">
                      <a href="{{ asset('product-list.html') }}" class="body-text">Sojos
                        Crunchy Natural Grain Free...</a>
                    </div>
                  </div>
                </li>
                <li class="mb-10">
                  <div class="divider"></div>
                </li>
                <li class="product-item gap14 mb-10">
                  <div class="image no-bg">
                    <img src="{{ asset('images/products/21.png') }}" alt="">
                  </div>
                  <div class="flex items-center justify-between gap20 flex-grow">
                    <div class="name">
                      <a href="{{ asset('product-list.html') }}" class="body-text">Kristin
                        Watson</a>
                    </div>
                  </div>
                </li>
                <li class="mb-10">
                  <div class="divider"></div>
                </li>
                <li class="product-item gap14 mb-10">
                  <div class="image no-bg">
                    <img src="{{ asset('images/products/22.png') }}" alt="">
                  </div>
                  <div class="flex items-center justify-between gap20 flex-grow">
                    <div class="name">
                      <a href="{{ asset('product-list.html') }}" class="body-text">Mega
                        Pumpkin Bone</a>
                    </div>
                  </div>
                </li>
                <li class="mb-10">
                  <div class="divider"></div>
                </li>
                <li class="product-item gap14">
                  <div class="image no-bg">
                    <img src="{{ asset('images/products/23.png') }}" alt="">
                  </div>
                  <div class="flex items-center justify-between gap20 flex-grow">
                    <div class="name">
                      <a href="{{ asset('product-list.html') }}" class="body-text">Mega
                        Pumpkin Bone</a>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
          </ul> --}}
        </div>
      </form>

    </div>
    <div class="header-grid">

      <div class="popup-wrap message type-header">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2"
            data-bs-toggle="dropdown" aria-expanded="false">
            <span class="header-item">
              <span class="text-tiny">1</span>
              <i class="icon-bell"></i>
            </span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton2">
            <li>
              <h6>Notifications</h6>
            </li>
            <li>
              <div class="message-item item-1">
                <div class="image">
                  <i class="icon-noti-1"></i>
                </div>
                <div>
                  <div class="body-title-2">Discount available</div>
                  <div class="text-tiny">Morbi sapien massa, ultricies at rhoncus
                    at, ullamcorper nec diam</div>
                </div>
              </div>
            </li>
            <li>
              <div class="message-item item-2">
                <div class="image">
                  <i class="icon-noti-2"></i>
                </div>
                <div>
                  <div class="body-title-2">Account has been verified</div>
                  <div class="text-tiny">Mauris libero ex, iaculis vitae rhoncus
                    et</div>
                </div>
              </div>
            </li>
            <li>
              <div class="message-item item-3">
                <div class="image">
                  <i class="icon-noti-3"></i>
                </div>
                <div>
                  <div class="body-title-2">Order shipped successfully</div>
                  <div class="text-tiny">Integer aliquam eros nec sollicitudin
                    sollicitudin</div>
                </div>
              </div>
            </li>
            <li>
              <div class="message-item item-4">
                <div class="image">
                  <i class="icon-noti-4"></i>
                </div>
                <div>
                  <div class="body-title-2">Order pending: <span>ID 305830</span>
                  </div>
                  <div class="text-tiny">Ultricies at rhoncus at ullamcorper</div>
                </div>
              </div>
            </li>
            <li><a href="#" class="tf-button w-full">View all</a></li>
          </ul>
        </div>
      </div>

      <div class="popup-wrap user type-header">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3"
            data-bs-toggle="dropdown" aria-expanded="false">
            <span class="header-user wg-user">
              <span class="image">
                <img src="{{ asset('images/logo-fikri.png') }}" alt="">
              </span>
              <span class="flex flex-column">
                <span class="body-title mb-2">Kristin Watson</span>
                <span class="text-tiny">Admin</span>
              </span>
            </span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton3">
            <li>
              <a href="#" class="user-item">
                <div class="icon">
                  <i class="icon-user"></i>
                </div>
                <div class="body-title-2">Account</div>
              </a>
            </li>
            <li>
              <a href="#" class="user-item">
                <div class="icon">
                  <i class="icon-mail"></i>
                </div>
                <div class="body-title-2">Inbox</div>
                <div class="number">27</div>
              </a>
            </li>
            <li>
              <a href="#" class="user-item">
                <div class="icon">
                  <i class="icon-file-text"></i>
                </div>
                <div class="body-title-2">Taskboard</div>
              </a>
            </li>
            <li>
              <a href="#" class="user-item">
                <div class="icon">
                  <i class="icon-headphones"></i>
                </div>
                <div class="body-title-2">Support</div>
              </a>
            </li>
            <li>
              <a href="#" class="user-item">
                <div class="icon">
                  <i class="icon-log-out"></i>
                </div>
                <div class="body-title-2">Log out</div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
