<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('admin.profil-index') }}">Profil</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
            @csrf
            {{-- <button>test</button> --}}
            <button class=" dropdown-item" type="button" onclick="logout()">Keluar</button>
          </form>
          
        </div>
      </li>
      <!-- Navbar Search -->
      {{-- <li class="nav-item">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
            @csrf
            <button class=" btn btn-danger btn-sm" type="button" onclick="logout()">Logout</button>
        </form>
    </li> --}}
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->
@push('after-script')
    <script>
        function logout(){
            Swal.fire({
            title: 'Yakin mengakhiri sesi ini?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yakin, logout sekarang!'
            }).then((result) => {
            if (result.isConfirmed) {
                $('#logout-form').submit();
            }
            });
        }
    </script>
@endpush