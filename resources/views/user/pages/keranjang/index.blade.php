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
                            <th colspan="2">PRODUK</th>
                            {{-- <th>NAME</th> --}}
                            <th class="text-center">HARGA SATUAN</th>
                            <th class="text-center">KUANTITAS</th>
                            <th class="text-center">TOTAL HARGA</th> 
                            <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach($data as $item)
                        {{-- {{ dd($item) }} --}}
                        <tr>
                            <td class="image" ><img src="{{ asset($item->product->images->first()->dir_photo) }}" alt="#"></td>
                            <td class="product-des" data-title="Description">
                                <p class="product-name"><a href="#">{{ $item->product->name }}</a></p>
                                <p class="product-des">Ukuran : {{ $item->detail->size }}</p>
                            </td>
                            <td class="price" data-title="Price"><span>Rp. {{ $item->detail->price }} </span></td>
                            <td class="qty" data-title="Qty"><!-- Input Order -->
                                <div class="input-group">
                                    <div class="button minus">
                                        <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[{{ $loop->iteration }}]">
                                            <i class="ti-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="quant[{{ $loop->iteration }}]" class="input-number" onchange="qty(this.value, {{ $item->id }})"  data-min="1" data-max="100" value="{{ $item->qty }}">
                                    <div class="button plus">
                                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[{{ $loop->iteration }}]">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!--/ End Input Order -->
                            </td>
                            <td class="total-amount" id="total{{ $loop->iteration }}"><span>Rp. {{ $item->qty * $item->detail->price }}</span></td>
                            <td class="action" data-title="Remove">
                                <form action="{{ route('user.keranjang-delete', $item->id) }}" method="POST" id="submit-delete{{ $item->id }}">
                                @csrf
                                @method('delete')
                                </form>
                                <a href="#" onclick="$('#submit-delete{{ $item->id }}').submit()"><i class="ti-trash remove-icon"></i></a>
                            </td>
                        </tr>
                        @php
                            $total += $item->qty * $item->detail->price;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                <!--/ End Shopping Summery -->
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-12">
                <!-- Total Amount -->
                <div class="total-amount">
                    <div class="row">
                        <div class="col-lg-8 col-md-5 col-12">
                        </div>
                        <div class="col-lg-4 col-md-7 col-12">
                            <div class="right">
                                <ul>
                                    <li>Total Bayar<span>Rp. {{ $total }}</span></li>
                                    <li>Shipping<span>Free</span></li>
                                    <li>You Save<span>$20.00</span></li>
                                    <li class="last">You Pay<span>$310.00</span></li>
                                </ul>
                                <div class="button5">
                                    <a href="#" class="btn">Checkout</a>
                                    <a href="#" class="btn">Continue shopping</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Total Amount -->
            </div>
        </div> --}}
        <!-- Start Checkout -->
        <section class="shop checkout section">
            <div class="container">
                <form class="form" method="POST" action="{{ route('user.keranjang-addTransaction') }}">
                    @csrf
                    <div class="row"> 
                        <div class="col-lg-8 col-12">
                            <div class="checkout-form">
                                <h4>Alamat Pengiriman</h4>
                                <br>
                                <!-- Form -->
                                <div class="form">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Nama Lengkap<span>*</span></label>
                                            <input type="text" name="name" placeholder="" required="required" value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Nomor Telepon<span>*</span></label>
                                            <input type="text" name="no_telp" placeholder="" required="required" value="{{ Auth::user()->address()->get()->isEmpty() ? '' : Auth::user()->address()->first()->no_telp }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Provinsi<span>*</span></label>
                                            <select name="provinsi_id" id="provinsi">
                                                <option >-- Pilih Provinsi --</option>
                                                @foreach ($provinsi as $prov)
                                                @if (Auth::user()->address()->get()->isEmpty())
                                                <option value="{{ $prov['province_id'] }}" >{{ $prov['province'] }}</option>
                                                @else
                                                <option value="{{ $prov['province_id'] }}" {{ Auth::user()->address()->first()->provinsi_id == $prov['province_id'] ? "selected" : "" }}>{{ $prov['province'] }}</option>
                                                @endif
                                                
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Kota/Kabupaten<span>*</span></label>
                                            <select name="kota_id" id="kota">
                                                <option >-- Pilih Kota/Kab --</option>
                                                @if (!Auth::user()->address()->get()->isEmpty())
                                                @foreach ($kota as $kt)   
                                                <option value="{{ $kt['city_id'] }}" {{ Auth::user()->address()->first()->kota_id == $kt['city_id'] ? "selected" : "" }}>{{ $kt['city_name'] }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Alamat Lengkap<span>*</span></label>
                                            <input type="text" name="address" placeholder="" required="required" value="{{ Auth::user()->address()->get()->isEmpty() ? '' : Auth::user()->address()->first()->address }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Kode Pos<span>*</span></label>
                                            <input type="text" name="post_code" placeholder="" required="required" value="{{ Auth::user()->address()->get()->isEmpty() ? '' : Auth::user()->address()->first()->post_code }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        
                                    </div>
                                </div>
                            </div>
                                <!--/ End Form -->
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="order-details">
                                <div class="single-widget">
                                    <h2>Kurir</h2>
                                    <div class="content">
                                        <ul>
                                            <li>JNE(REG) <span>Estimasi 1-2 Hari</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Order Widget -->
                                <div class="single-widget">
                                    <h2>Total Pembelian</h2>
                                    <div class="content">
                                        <ul>
                                            <li>Total Harga<span>Rp. {{ $total }}</span></li>
                                            <li>(+) Ongkir <span>Rp. <span id="ongkir">0</span> </span></li>
                                            <li class="last">Total Pembayaran<span>Rp. <span id="total">0</span></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <!--/ End Order Widget -->
                                <!-- Order Widget -->
                                <div class="single-widget">
                                    <h2>Pembayaran</h2>
                                    <div class="content">
                                        <ul>
                                            <li>Transfer Bank<span>(Bank BRI)</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <!--/ End Order Widget -->
                                <!-- Button Widget -->
                                <div class="single-widget get-button">
                                    <div class="content">
                                        <div class="button">
                                            <button type="submit" class="btn">proceed to checkout</button>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Button Widget -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        
<!--/ End Checkout -->
    </div>
</div>
<!--/ End Shopping Cart -->

	
@endsection

@push('after-script')
<script>
    $(document).ready(function(){
        // alert('waw');
        $('#provinsi').change(function(){
            var id = this.value;
            $("#ongkir").html("0");
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
        // alert($('#kota > option:selected').val());
         if ($('#kota > option:selected').val() !== "") {
            var id = $('#kota > option:selected').val();
            // alert(id);
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
        }
    });
    function qty(value, id){
        var qty = value;
        // alert(qty);
        var id = id;
        var token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('user.keranjang-addQty') }}",
            method: "POST",
            data:{
                qty: qty,
                id: id,
                _token: token
            },
            success: function(result){
                
                // $("#kota").html(result);
                // $("#kota").removeAttr('disabled').niceSelect('update');
            }
        });
        location.reload();
    }
</script>
@endpush