@extends('user.layouts.default')

@section('content')
 


        
<!-- Shopping Cart -->
<div class="shopping-cart section">
    <div class="container">
        
        <div class="row">
            <div class="col-12">
                <!-- Shopping Summery -->
                <table class="table shopping-summery">
                    <thead>
                        <tr class="main-hading">
                            <th >PRODUK</th>
                            {{-- <th>NAME</th> --}}
                            <th class="text-center">TOTAL HARGA</th> 
                            <th class="text-center">STATUS</th>
                            <th class="text-center">RESI</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach($data as $item)
                        {{-- {{ dd($item) }} --}}
                        <tr>
                            <td class="product-des" data-title="Description">
                                @foreach ($item->transaction_product as $transaction_product)    
                                    <p class="product-name"><a href="#">{{ $transaction_product->product_name }}</a></p>
                                    <p class="product-des">Detail : {{ $transaction_product->qty }} x {{ $transaction_product->price }} | Ukuran {{ $transaction_product->size }}</p>
                                    {{-- <p class="product-des"> : {{ $transaction_product->size }}</p> --}}
                                @endforeach
                            </td>
                            <td class="price" data-title="Price"><span>Rp. {{ $item->total_price + $item->ongkir_price }} </span></td>
                            <td class="price" data-title="Price"><span class="badge badge-primary">{{ $item->status }}</span></td>
                            <td class="price" data-title="Price">{{ isset($item->resi->resi) ? $item->resi->resi : "-" }}</td>
                            <td class="text-center">
                                @if ($item->status == "menunggu pembayaran")
                                    <a class="btn text-white" href="{{ route('user.pesanan-show', $item->id) }}" >Upload Bukti Transfer</a>
                                {{-- @elseif ($item->status == "menunggu konfirmasi")
                                    <a class="btn text-white" href="{{ route('user.pesanan-show', $item->id) }}" >Ubah Bukti Transfer</a> --}}
                                @elseif ($item->status == "dikirim")
                                    Pesanan Sampai
                                @else
                                    -
                                @endif
                                
                            </td>
                        </tr>
                        @php
                            // $total += $item->qty * $item->detail->price;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                <!--/ End Shopping Summery -->
            </div>
        </div>
        
        
<!--/ End Checkout -->
    </div>
</div>
<!--/ End Shopping Cart -->

	
@endsection

@push('after-script')
<script>
    $(document).ready(function(){
        // alert($('#kota').value);
        $('#provinsi').change(function(){
            var id = this.value;
            var token = $('input[name="_token"]').val();
            $("#kota").html("<option>Sedang memuat ...</option>");
            $("#kota").prop('disabled', true);
            $("#kota").niceSelect('update');
            $.ajax({
                url: "{{ route('user.keranjang-getKota') }}",
                method: "POST",
                data:{
                    province_id: id,
                    _token: token
                },
                success: function(result){
                    // console.log(result);
                    $("#kota").html(result);
                    $("#kota").removeAttr('disabled').niceSelect('update');
                }
            });

            // $("#kota").removeAttr('style');
        });

        $('#kota').change(function(){
            var id = this.value;
            var token = $('input[name="_token"]').val();
            $("#ongkir").html("0");
            $.ajax({
                url: "{{ route('user.keranjang-getOngkir') }}",
                method: "POST",
                data:{
                    city_id: id,
                    _token: token
                },
                success: function(result){
                    // console.log(result);
                    $("#ongkir").html(result['value']);
                    $("#total").html(@json($total) + result['value']);
                }
            });
            
            // $("#kota").removeAttr('style');
        });
            
       
            
        
    });
</script>
@endpush