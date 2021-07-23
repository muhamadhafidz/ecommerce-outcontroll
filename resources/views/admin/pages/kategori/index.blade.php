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
                          
                        <h2 class="card-title font-weight-bold ">Daftar Kategori </h2>
                      </div>
                      <div class="col text-right">
                        <a href="{{ route('admin.kategori-create') }}" class="btn btn-success btn-sm">+ Tambah Kategori</a>
                      </div>
                  </div>
              </div>
              <div class="card-body">
                  <table class="table table-striped"  id="crudTable">
                      <thead>
                          <th>No</th>
                          <th>Kategori</th>
                          <th>Aksi</th>
                      </thead>
                      <tbody>
                          @foreach ($data as $item)
                          {{-- {{ dd($data) }} --}}
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="">
                              <a href="{{ route('admin.kategori-edit',$item->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                              <form action="{{ route('admin.kategori-delete', $item->id) }}" method="post" id="form-hapus-{{ $item->id }}" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="button" onclick="hapus({{ $item->id }})" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
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
            { "width": "15%", "targets": 1 },
            { "width": "10%", "orderable": false, "targets": 2 },
          ]
        });
        // $('#reservation').daterangepicker();
    });
    function hapus(id){
        Swal.fire({
        title: 'Yakin menghapus kategori ini?',
        text: "Semua produk yang berkategori ini akan terhapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin, hapus kategori ini!'
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
            }
        });
    }
</script>
@endpush