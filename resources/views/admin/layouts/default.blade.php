<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Out Controll</title>
    <!--     Fonts and icons     -->
    @include('admin.includes.font')
    <!-- CSS Files -->
    @stack('before-style')
    @include('admin.includes.style')
    @stack('after-style')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
    
      <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('assets/user/images/logo.jpg') }}" alt="AdminLTELogo" height="100" width="100">
        </div>
        @include('admin.includes.navbar')
        {{-- sidebar --}}
        @include('admin.includes.sidebar')
        {{-- end sidebar --}}

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                {{-- <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid --> --}}
            </div>
            <!-- /.content-header -->
            <section class="content">
            @yield('content')
            </section>
            <!-- End Navbar -->
        </div>

            {{-- @include('admin.includes.footer') --}}
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

</body>
@stack('before-script')
@include('admin.includes.script')
@stack('after-script')
@include('sweetalert::alert')
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
{{-- <script src="../assets/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.showNotification();

    });
</script> --}}

</html>
