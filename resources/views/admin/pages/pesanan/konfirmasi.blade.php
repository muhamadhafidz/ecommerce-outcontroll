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
                          
                        <h2 class="card-title font-weight-bold ">Daftar Pesanan <span class="badge badge-dark">Menunggu Konfirmasi</span></h2>
                      </div>
                  </div>
              </div>
              <div class="card-body">
                  <table class="table table-striped"  id="crudTable">
                      <thead>
                          <th>No</th>
                          <th>Pembeli</th>
                          <th>Total Harga</th>
                          <th>Status</th>
                          <th>Bukti Transfer</th>
                          <th>Aksi</th>
                      </thead>
                      <tbody>
                          @foreach ($data as $item)
                          {{-- {{ dd($data) }} --}}
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>Rp. {{ $item->total_price }}</td>
                            <td><span class="badge badge-secondary">{{ $item->status }}</span></td>
                            <td>
                                <a class="image-link" href="{{ asset($item->bukti->dir_payment_pic) }}">
                                    <img class="img-fluid" src="{{ asset($item->bukti->dir_payment_pic) }}" alt="">
                                </a>
                            </td>
                            <td class="">
                                <form action="{{ route('admin.pesanan-valid', $item->id) }}" method="post" id="form-valid-{{ $item->id }}" class="d-inline">
                                    @csrf
                                    @method('put')
                                    <button type="button" onclick="valid({{ $item->id }})" class="btn btn-success btn-sm">Pembayaran Valid</button>
                                </form>
                                {{-- <form action="{{ route('admin.pesanan-delete', $item->id) }}" method="post" id="form-valid-{{ $item->id }}" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="button" onclick="valid({{ $item->id }})" class="btn btn-danger btn-sm">valid</button>
                                </form> --}}
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
@push('after-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" integrity="sha512-WEQNv9d3+sqyHjrqUZobDhFARZDko2wpWdfcpv44lsypsSuMO0kHGd3MQ8rrsBn/Qa39VojphdU6CMkpJUmDVw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@push('after-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function submit()
    {
        $('#form-modal').submit();
    }

    $(document).ready(function(){
        $('#crudTable').DataTable({
          "columnDefs": [
            { "width": "5%", "targets": 0 },
            { "width": "20%", "targets": 2 },
            { "width": "20%", "targets": 4 },
            { "orderable": false, "targets": 5 },
          ]
        });
        $('.image-link').magnificPopup({type:'image'});
        // $('#reservation').daterangepicker();
    });
    function valid(id){
        Swal.fire({
        title: 'Yakin pembayaran sudah valid?',
        text: "",
        icon: 'danger',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin, proses pesanan sekarang!'
        }).then((result) => {
        if (result.isConfirmed) {
            $('#form-valid-'+id).submit();
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