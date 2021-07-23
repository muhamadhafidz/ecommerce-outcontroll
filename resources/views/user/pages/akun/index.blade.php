@extends('user.layouts.default')

@section('content')
 


        
<!-- Shopping Cart -->
<div class="shopping-cart section">
    <div class="container">
        <section class="shop checkout section">
            <div class="container">
                <form class="form" method="POST" action="{{ route('user.akun-update') }}">
                    @csrf
                    <div class="row justify-content-center"> 
                        <div class="col-lg-8 col-12">
                            <div class="checkout-form">
                                <h4>Data Profil</h4>
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
                                    <div class="button">
                                        <button type="submit" class="btn">Ubah Profil</button>
                                    </div>
                                </div>
                                <!--/ End Form -->
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
                }
            });
            
            // $("#kota").removeAttr('style');
        });
        // alert($('#kota > option:selected').val());
         
    });
</script>
@endpush