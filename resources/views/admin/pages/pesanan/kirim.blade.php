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
                          
                        <h2 class="card-title font-weight-bold ">Daftar Pesanan <span class="badge badge-dark">Dikirim</span></h2>
                      </div>
                  </div>
              </div>
              <div class="card-body">
                  <table class="table table-striped"  id="crudTable">
                      <thead>
                          <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Alamat</th>
                            <th>Pembeli</th>
                            <th>Status</th>
                            <th>Resi</th>
                            <th>Aksi</th>
                          </tr>
                          
                      </thead>
                      <tbody>
                          @foreach ($data as $item)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-break">
                                @foreach ($item->transaction_product as $tProduct)
                                    
                                    <a href="" class="text-dark">
                                        <u>
                                            <h5 class="font-weight-bold">
                                            {{ $tProduct->product_name }} 
                                            </h5>
                                        </u>
                                    </a>
                                    (Ukuran : {{ $tProduct->size }} | Kuantitas : {{ $tProduct->qty }} Pcs)
                                @endforeach
                            </td>
                            <td class="text-break">{{ $item->address }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>
                                <span class="badge badge-secondary">{{ $item->status }}</span>
                            </td>
                            <td>
                              {{ $item->resi->resi }}
                            </td>
                            <td>
                              <form action="{{ route('admin.pesanan-sampai', $item->id) }}" method="post" id="form-sampai-{{ $item->id }}" class="d-inline">
                                @csrf
                                @method('put')
                                <button type="button" onclick="sampai({{ $item->id }})" class="btn btn-success btn-sm">Barang Sampai</button>
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
            { "width": "25%","orderable": false, "targets": 1 },
            { "width": "40%","orderable": false, "targets": 2 },
            { "width": "10%", "targets": 3 },
            { "width": "10%", "targets": 4 },
            { "width": "10%", "orderable": false, "targets": 5 },
            { "orderable": false, "targets": 6 },
          ]
        });
        // $('#reservation').daterangepicker();
    });
    
    function sampai(id){
        Swal.fire({
        title: 'Yakin pesanan sudah sampai?',
        text: "Pastikan kembali pesanan ini telah sampai ke pelanggan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin, pesanan telah sampai!'
        }).then((result) => {
        if (result.isConfirmed) {
            $('#form-sampai-'+id).submit();
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