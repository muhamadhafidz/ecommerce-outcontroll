
  
  <!-- End Topbar -->
  <div class="middle-inner">
    <div class="container">
      <div class="row">
        <div class="col-lg-2 col-md-2 col-12">
          <!-- Logo -->
          <div class="logo mt-0" style="width: 100px;">
            <a href="{{ route('user.home') }}"><img class="img-fluid" height="20" src="{{ asset('assets/user/images/logo.jpg') }}" alt="logo"><br></a>
          </div>
          <!--/ End Logo -->
          <!-- Search Form -->
          <div class="search-top">
            
            <div class="top-search d-inline mr-2"><a href="#0"><i class="ti-search"></i></a></div>
            <div class="sinlge-bar shopping">
              <a href="#" class="single-icon"><i class="ti-bag"></i> <span class="total-count">2</span></a>
              <!-- Shopping Item -->
              <div class="shopping-item">
                <div class="dropdown-cart-header">
                  <span>{{ $hcart->count() }} Barang</span>
                  {{-- <a href="#">View Cart</a> --}}
                </div>
                <ul class="shopping-list">
                  @foreach ($hcart as $item)
                  <li>
                    <a class="cart-img" href="#"><img src="{{ asset($item->product->images->first()->dir_photo) }}" alt="#"></a>
                    <h4><a href="#">{{ $item->product->name }}</a></h4>
                    <p class="quantity">Uk : {{ $item->detail->size }} | {{ $item->qty }}x - <span class="amount">Rp. {{ $item->detail->price }}</span></p>
                  </li>
                  @endforeach

                </ul>
                <div class="bottom">
                  <div class="total">
                    <span>Total</span>
                    <span class="total-amount">$134.00</span>
                  </div>
                  <a href="{{ route('user.keranjang') }}" class="btn animate">Lihat Keranjang</a>
                </div>
              </div>
              <!--/ End Shopping Item -->
            </div>
            <!-- Search Form -->
            <div class="search-top">
              <form class="search-form">
                <input type="text" placeholder="Search here..." name="search">
                <button value="search" type="submit"><i class="ti-search"></i></button>
              </form>
            </div>
            <!--/ End Search Form -->
            
          </div>
          
          <!--/ End Search Form -->
          <div class="mobile-nav"></div>
        </div>
        <div class="col-lg-8 col-md-7 col-12">
          <div class="search-bar-top">
            <div class="search-bar">
              <form class="w-100" action="{{ route('user.produk-search') }}" method="GET">
                <input class="w-100" name="search" placeholder="Cari Produk Disini...." type="search">
                <button class="btnn"><i class="ti-search"></i></button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-3 col-12">
          <div class="right-bar">

            <div class="sinlge-bar shopping">
              
              <a href="#" class="single-icon"><i class="ti-bag"></i> {!! $hcart->count() > 0 ? '<span class="total-count">'.$hcart->count().'</span>' : ''  !!}</a>
              <!-- Shopping Item -->
              <div class="shopping-item">
                <div class="dropdown-cart-header">
                  <span>{{ $hcart->count() }} Barang</span>
                  {{-- <a href="#">View Cart</a> --}}
                </div>
                <ul class="shopping-list">
                  @php
                      $tot = 0;
                  @endphp
                  @foreach ($hcart as $item)
                  <li>
                    <a class="cart-img" href="#"><img src="{{ asset($item->product->images->first()->dir_photo) }}" alt="#"></a>
                    <h4><a href="#">{{ $item->product->name }}</a></h4>
                    <p class="quantity">Uk : {{ $item->detail->size }} | {{ $item->qty }}x - <span class="amount">Rp. {{ $item->detail->price }}</span></p>
                  </li>
                  @php
                      $tot += $item->qty * $item->detail->price;
                  @endphp
                  @endforeach
                </ul>
                <div class="bottom">
                  <div class="total">
                    <span>Total</span>
                    <span class="total-amount">Rp. {{ $tot }}</span>
                  </div>
                  <a href="{{ route('user.keranjang') }}" class="btn animate">Lihat Keranjang</a>
                </div>
              </div>
              <!--/ End Shopping Item -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  