<!-- Header Inner -->
<div class="header-inner">
    <div class="container">
      <div class="cat-nav-head">
        <div class="row">

          <div class="col-lg-9 col-12">
            <div class="menu-area">
              <!-- Main Menu -->
              <nav class="navbar navbar-expand-lg">
                <div class="navbar-collapse">	
                  <div class="nav-inner">	
                    <ul class="nav main-menu menu navbar-nav">
                        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('user.home') }}">Home</a></li>
                        <li class="{{ Request::is('produk*') ? 'active' : '' }}"><a href="{{ route('user.produk') }}">Produk</a></li>												
                        <!-- <li><a href="#">Service</a></li> -->
                        <li class="{{ Request::is('keranjang*') ||  Request::is('pesanan*') ? 'active' : '' }}"><a href="#">Pembelian<i class="ti-angle-down"></i>
                          <!-- <span class="new">New</span> -->
                        </a>
                          <ul class="dropdown">
                            <li class="{{ Request::is('pesanan*') ? 'active' : '' }}"><a href="{{ route('user.pesanan') }}">Pesanan Saya</a></li>
                            <li class="{{ Request::is('keranjang*') ? 'active' : '' }}"><a  href="{{ route('user.keranjang') }}">Keranjang</a></li>
                            <!-- <li><a href="checkout.html">Checkout</a></li> -->
                          </ul>
                        </li>
                      </ul>
                  </div>
                </div>
              </nav>
              <!--/ End Main Menu -->	
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ End Header Inner -->