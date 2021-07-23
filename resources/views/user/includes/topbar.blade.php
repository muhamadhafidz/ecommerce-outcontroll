<!-- Topbar -->
<div class="topbar">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-12 col-12">
          <!-- Top Left -->
          <div class="top-left">
            <ul class="list-main">
              <li><i class="ti-headphone-alt"></i> 081228290100 </li>
              <li> <i class="ti-email"></i> outcontroll29@gmail.com</li>
            </ul>
          </div>
          <!--/ End Top Left -->
        </div>
        <div class="col-lg-8 col-md-12 col-12">
          <!-- Top Right -->
          <div class="right-content">
            <ul class="list-main">
              <li><i class="ti-location-pin"></i> Jakarta Selatan</li>
              @auth
              <li><i class="ti-user"></i> <a href="{{ route('user.akun') }}">Akun Saya</a></li>
              <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();"><i class="ti-power-off"></i>
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    {{-- <a href=""></a> --}}
                </form>
              </li>
              @endauth
              @guest
              <li><i class="ti-power-off"></i><a href="{{ route('login') }}">Masuk</a></li>
              @endguest
            </ul>
          </div>
          <!-- End Top Right -->
        </div>
      </div>
    </div>
  </div>