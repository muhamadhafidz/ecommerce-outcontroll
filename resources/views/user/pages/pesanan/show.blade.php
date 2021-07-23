@extends('user.layouts.default')

@section('content')

        
<!-- Start Checkout -->
<section class="shop checkout section">
    <div class="container">
        <div class="row"> 
            <div class="col-12">
                <div class="checkout-form text-center py-5">
                    <h4>DETAIL TRANSAKSI</h4>
                    <p class="mb-1 mt-2">Nomor Rekening</p>
                    <h5>821938372123821312 (Bank BNI) a/n Loki</h5>
                    <p class="mb-1">Total Pembayaran</p>
                    <h5>Rp. {{ $data->total_price + $data->ongkir_price }}</h5>
                </div>
                <div class="row">
                    <div class="offset-3 col-6">
                        <div class="card">
                            <h5 class="card-header">Bukti Transfer</h5>
                            <div class="card-body">
                                <form action="{{ route('user.pesanan-bukti', $data->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="file" name="bukti" class="form-control">
                                    </div>
                                    <div class="my-3 text-center">
                                        <button type="submit" class="btn w-100 text-white">Upload Bukti Transfer</button>
                                        {{-- <a href="">Kembali</a> --}}
                                    </div>
                                </form>
                            </div>
                          </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Checkout -->

	
@endsection

@push('after-script')

@endpush