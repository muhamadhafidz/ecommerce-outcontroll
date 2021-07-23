@extends('admin.layouts.default')

@section('content')
{{-- {{  }} --}}
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ $transaction_confirm }}</h3>
  
                  <p>Pesanan menunggu konfirmasi</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('admin.pesanan-konfirmasi') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ $user }}</h3>
  
                  <p>Jumlah Customer</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('admin.pelanggan') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{ $transaction_success }}</h3>
  
                  <p>Total Transaksi Sukses</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('admin.pesanan-selesai') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>Rp. {{ $transaction_money }}</h3>
  
                  <p>Total Pendapatan</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <div class="small-box-footer"> </div>
              </div>
            </div>
          </div>
    </div>
</div>
<!-- Button trigger modal -->


@endsection

@push('after-script')
<script>
    function submit()
    {
        $('#form-modal').submit();
    }

    $(document).ready(function(){
        $('#crudTable').DataTable();
        $('#reservation').daterangepicker();
    });
    function hapus(id){
        Swal.fire({
        title: 'Yakin menghapus akun asisten ini?',
        text: "Kamu tidak akan bisa mengembalikan datanya!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin, hapus akun asisten ini!'
        }).then((result) => {
        if (result.isConfirmed) {
            $('#form-hapus-'+id).submit();
        }
        });
    }
    function resetPass(id){
        Swal.fire({
            title: 'Yakin reset password akun asisten ini?',
            text: "Kamu tidak akan bisa mengembalikan datanya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yakin, reset password akun asisten ini!'
            }).then((result) => {
            if (result.isConfirmed) {
                $('#form-reset-'+id).submit();
            }
        });
    }
</script>
@endpush