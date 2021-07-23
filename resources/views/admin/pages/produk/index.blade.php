@extends('admin.layouts.default')

@section('content')
{{-- {{  }} --}}
<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
          <div class="card strpied-tabled-with-hover">
              <div class="card-header ">
                  <div class="row ">
                      <div class="col ">
                          
                        <h2 class="card-title font-weight-bold ">Daftar Produk </h2>
                      </div>
                      <div class="col text-right">
                        <a href="{{ route('admin.produk-create') }}" class="btn btn-success btn-sm">+ Tambah Produk</a>
                      </div>
                  </div>
              </div>
              <div class="card-body">
                  <table class="table table-striped"  id="crudTable">
                      <thead>
                          <th>No</th>
                          <th>Foto</th>
                          <th>Nama Barang</th>
                          <th>Kategori</th>
                          <th>Informasi Penjualan</th>
                          <th>Terjual</th>
                          <th>Aksi</th>
                          <th>Aktif</th>
                      </thead>
                      <tbody>
                          @foreach ($data as $item)
                          {{-- {{ dd($data) }} --}}
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                              {{-- <div class=""> --}}

                                <img class="img-fluid" src="{{ asset( $item->images->first()->dir_photo ) }}" alt=""></td>
                              {{-- </div> --}}
                            <td class="align-middle ">
                              <a href="" class="text-dark">
                                <u>
                                  <h5 class="font-weight-bold">
                                    {{ $item->name }}
                                  </h5>
                                </u>
                              </a>
                              
                            </td>
                            <td class="align-middle">{{ $item->category->name }}</td>
                            <td class="align-middle text-center">
                              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="detail({{ $item->id }})">
                                Lihat
                              </button>
                              
                            </td >
                            <td>{{ $item->sold }}</td>
                            <td class="align-middle">
                              <a href="{{ route('admin.produk-edit',$item->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                              <form action="{{ route('admin.produk-delete', $item->id) }}" method="post" id="form-hapus-{{ $item->id }}" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="button" onclick="hapus({{ $item->id }})" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                            </td>
                            <td>
                              <div class="custom-control custom-switch">
                                
                                <input type="checkbox" class="custom-control-input" id="customSwitch{{ $item->id }}" {{ $item->active == "y" ? "checked" : "" }} onclick="status({{ $item->id }})">
                                <label class="custom-control-label" for="customSwitch{{ $item->id }}"></label>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                          
                          
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- Button trigger modal -->
<!-- Modal -->

@include('admin.pages.produk.detail')

@endsection

@push('after-script')
<script>
    function submit()
    {
        $('#form-modal').submit();
    }

    $(document).ready(function(){
        $('#crudTable').DataTable({
          "columnDefs": [
            { "width": "5%", "targets": 0 },
            { "width": "10%", "orderable": false, "targets": 1 },
            { "width": "15%", "targets": 3 },
            { "width": "10%", "orderable": false, "targets": 4 },
            { "width": "20%", "orderable": false, "targets": 5 },
            { "width": "5%", "targets": 6 }
          ]
        });
        // $('#reservation').daterangepicker();
    });
    function hapus(id){
        Swal.fire({
        title: 'Yakin menghapus produk ini?',
        text: "Jika kamu menghapus produk ini semua riwayat transaksi untuk produk ini akan terhapus juga!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin, hapus produk ini!'
        }).then((result) => {
        if (result.isConfirmed) {
            $('#form-hapus-'+id).submit();
        }
        });
    }

    function detail(id_product) 
    {
        // alert("waw");
        // $('#jadwal_id').val(id_jadwal);
        var idProduct = id_product;
        var token = $('input[name="_token"]').val();
        // alert("test");
        $.ajax({
            url: "{{ route('admin.produk-getDetails') }}",
            method: "POST",
            data:{
                id_product: idProduct,
                _token: token,
            },
            success: function(result){
                $('#detail').html(result);
                // $('#btn-edit').attr("href", route);
            }
        });
    }

    function status(id_product) 
    {
        // alert("waw");
        // $('#jadwal_id').val(id_jadwal);
        var idProduct = id_product;
        var token = $('input[name="_token"]').val();
        // alert("test");
        $.ajax({
            url: "{{ route('admin.produk-setStatus') }}",
            method: "POST",
            data:{
                id_product: idProduct,
                _token: token,
            },
            success: function(result){
                // $('#detail').html(result);
                // $('#btn-edit').attr("href", route);
            }
        });
    }
</script>
@endpush