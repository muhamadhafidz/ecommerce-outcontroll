<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">Out Controll</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 ">
        {{-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> --}}
        <div class="info text-center d-block">
          {{-- <a href="#" class="d-block">{{ Auth::user()->name }}</a> --}}
          <a href="#" class="">ADMIN AREA</a>
        </div>
      </div>

      
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Cari Halaman" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item ">
            
            <a class="nav-link  {{ Request::is('admin/dashboard*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('admin/daftar-produk*') ? 'menu-open' : '' }}">
            <a class="nav-link {{ Request::is('admin/daftar-produk*') ? 'active' : '' }}" href="">
              <i class="fas fa-shopping-basket nav-icon"></i>
              <p>
                Produk
                {{-- <span class="right badge badge-danger">New</span> --}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.produk') }}" class="nav-link {{ Request::is('admin/daftar-produk') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.produk-create') }}" class="nav-link {{ Request::is('admin/daftar-produk/create') ? 'active' : '' }}">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Tambah Produk</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ Request::is('admin/kategori*') ? 'menu-open' : '' }}">
            <a class="nav-link {{ Request::is('admin/kategori*') ? 'active' : '' }}" href="">
              <i class="fas fa-tags nav-icon"></i>
              <p>
                Kategori
                {{-- <span class="right badge badge-danger">New</span> --}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.kategori') }}" class="nav-link {{ Request::is('admin/kategori') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.kategori-create') }}" class="nav-link {{ Request::is('admin/kategori/create') ? 'active' : '' }}">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Tambah Kategori</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ Request::is('admin/pesanan*') ? 'menu-open' : '' }}">
            <a class="nav-link {{ Request::is('admin/pesanan*') ? 'active' : '' }}" href="">
              <i class="fas fa-boxes nav-icon"></i>
              <p>
                Pesanan
                {{-- <span class="right badge badge-danger">New</span> --}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.pesanan') }}" class="nav-link {{ Request::is('admin/pesanan') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Pesanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.pesanan-konfirmasi') }}" class="nav-link {{ Request::is('admin/pesanan/konfirmasi') ? 'active' : '' }}">
                  <i class="fas fa-money-bill nav-icon"></i>
                  <p>Konfirmasi Pembayaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.pesanan-proses') }}" class="nav-link {{ Request::is('admin/pesanan/proses') ? 'active' : '' }}">
                  <i class="fas fa-truck-loading nav-icon" ></i>
                  <p>Pesanan Diproses</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.pesanan-kirim') }}" class="nav-link {{ Request::is('admin/pesanan/kirim') ? 'active' : '' }}">
                  <i class="fas fa-shipping-fast nav-icon"></i>
                  <p>Pesanan Dikirim</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.pesanan-selesai') }}" class="nav-link {{ Request::is('admin/pesanan/selesai') ? 'active' : '' }}">
                  <i class="fas fa-check-square nav-icon"></i>
                  <p>Pesanan Selesai</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- <li class="nav-header">EXAMPLES</li> --}}
          <li class="nav-item ">
            
            <a class="nav-link  {{ Request::is('admin/pelanggan*') ? 'active' : '' }}" href="{{ route('admin.pelanggan') }}">
              <i class="fas fa-users nav-icon"></i>
              <p>
                Pelanggan
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          {{-- @if (Auth::user()->roles == 'staf')
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Staff
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link  {{ Request::is('admin/kelas*') ? 'active' : '' }}" href="{{ route('admin.kelas.index') }}">
                  <i class="fas fa-sitemap nav-icon"></i>
                  <p>Kelas</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link  {{ Request::is('admin/matkul*') ? 'active' : '' }}" href="{{ route('admin.matkul.index') }}">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Matkul</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link  {{ Request::is('admin/asisten*') ? 'active' : '' }}" href="{{ route('admin.asisten.index') }}">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Asisten</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link  {{ Request::is('admin/jadwal*') ? 'active' : '' }}" href="{{ route('admin.jadwal.index') }}">
                  <i class="fas fa-calendar-alt nav-icon"></i>
                  <p>Jadwal</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link  {{ Request::is('admin/rekap-absensi*') ? 'active' : '' }}" href="{{ route('admin.rekap-absensi.index') }}">
                  <i class="fas fa-list-alt nav-icon"></i>
                  <p>Rekap Absensi</p>
                </a>
              </li>
            </ul>
          </li>
          @endif --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>