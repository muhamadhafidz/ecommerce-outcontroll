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
                          
                        <h2 class="card-title font-weight-bold ">Daftar Pesanan <span class="badge badge-dark">Semua</span></h2>
                      </div>
                  </div>
              </div>
              <div class="card-body">
                  <table class="table table-striped"  id="crudTable">
                      <thead>
                          <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Total Harga</th>
                            <th>Pembeli</th>
                            <th>Status</th>
                          </tr>
                          
                      </thead>
                      <tbody>
                          @foreach ($data as $item)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-break">
                                @foreach ($item->transaction_product as $tProduct)
                                    {{-- <div class="row">
                                        <div class="col-4">
                                            <img class="img-fluid" src="{{ asset($tProduct->product->images->first()->dir_photo) }}" alt="">
                                        </div> --}}
                                        {{-- <div class="col"> --}}
                                            <a href="" class="text-dark">
                                                <u>
                                                  <h5 class="font-weight-bold">
                                                    {{ $tProduct->product_name }}
                                                  </h5>
                                                </u>
                                            </a>
                                            <ul class="pl-0" style="list-style-type: none">
                                                <li>Ukuran : {{ $tProduct->size }}</li>
                                                <li>Harga : Rp. {{ $tProduct->price }}</li>
                                                <li>Kuantitas : {{ $tProduct->qty }} Pcs</li>
                                            </ul>
                                        {{-- </div>
                                    </div> --}}
                                @endforeach
                            </td>
                            <td>Rp. {{ $item->total_price }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>
                                <span class="badge badge-secondary">{{ $item->status }}</span>
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
            { "orderable": false, "targets": 1 },
            { "width": "10%", "targets": 2 },
            { "width": "10%", "targets": 3 },
            { "width": "10%", "targets": 4 },
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