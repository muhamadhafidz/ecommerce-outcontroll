@extends('user.layouts.default')

@section('content')
 

<div class="detail">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4 offset-lg-1 col-md-12 col-sm-12 col-xs-12">
                <!-- Product Slider -->
                    <div class="product-gallery">
                        <div class="quickview-slider-active">
                            @foreach ( $data->images as $item )
                                <div class="single-slider">
                                    <img src="{{ asset($item->dir_photo) }}" alt="#">
                                </div>
                            @endforeach
                            
                            {{-- <div class="single-slider">
                                <img src="images/product.jpg" alt="#">
                            </div>
                            <div class="single-slider">
                                <img src="images/product.jpg" alt="#">
                            </div>
                            <div class="single-slider">
                                <img src="images/product.jpg" alt="#">
                            </div> --}}
                        </div>
                    </div>
                <!-- End Product slider -->
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="quickview-content">
                    <h2>Celana Jeans</h2>
                    <div class="quickview-ratting-review">
                        <!-- <div class="quickview-ratting-wrap">
                            <div class="quickview-ratting">
                                <i class="yellow fa fa-star"></i>
                                <i class="yellow fa fa-star"></i>
                                <i class="yellow fa fa-star"></i>
                                <i class="yellow fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <a href="#"> (1 customer review)</a>
                        </div> -->
                        <div class="quickview-stock m-0">
                            <span><i class="fa fa-check-circle-o"></i>Stok : 
                                @foreach ($data->detail as $item)   
                                    <span class="stock-product" {{ $loop->iteration == 1 ? '' : 'hidden' }} id="stock{{ $item->id }}">{{ $item->stock }}</span>
                                @endforeach
                            </span>
                        </div>
                    </div>
                    <h3>
                        
                        Rp. 
                    @foreach ($data->detail as $item)   
                        <span class="price-product" {{ $loop->iteration == 1 ? '' : 'hidden' }} id="price{{ $item->id }}">{{ $item->price }}</span>
                    @endforeach</h3>
                    <div class="quickview-peragraph">
                        <p>{{ $data->description }}</p>
                    </div>
                    <form action="{{ route('user.produk-add', $data->id) }}" method="POST" class="">
                        @csrf
                        <div class="size">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <h5 class="title">Ukuran</h5>
                                    <select name="detail_id" onchange="changeSize(value)">
                                        @foreach ($data->detail as $item)   
                                        <option {{ $loop->iteration == 1 ? "selected" : "" }} value="{{ $item->id }}">{{ $item->size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="quantity">
                                        <h5 class="title">Jumlah</h5>
                                        <!-- Input Order -->
                                        <div class="input-group">
                                            <div class="button minus">
                                                <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="qty">
                                                    <i class="ti-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" name="qty" class="input-number"  data-min="1" data-max="1000" value="1">
                                            <div class="button plus">
                                                <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="qty">
                                                    <i class="ti-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <!--/ End Input Order -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="add-to-cart">
                        
                        
                            <button type="submit" class="btn btn-link text-center">Tambah Ke Keranjang</a>
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Start Most Popular -->
<div class="product-area most-popular m-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title mb-2 mt-5">
                    <h2>Produk Serupa</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel popular-slider">
                    <!-- Start Single Product -->
                    @foreach ($produk as $item)
                    <div class="single-product">
                        <div class="product-img">
                          <a href="product-details.html">
                            <img class="default-img" src="{{ asset($item->images->first()->dir_photo) }}" alt="#">
                          </a>
                          <div class="button-head">
                            <div class="product-action-2 w-100 text-center">
                              <a title="Add to cart" href="#"><i class="fas fa-plus nav-icon"></i> Tambah Ke Keranjang</a>
                            </div>
                          </div>
                        </div>
                        <div class="product-content">
                          <h3><a href="product-details.html">{{ $item->name }}</a></h3>
                          <div class="product-price">
                            
                            <span>Rp. {{ $item->detail->first()->price }}</span>
                          </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Most Popular Area -->

	
@endsection

@push('after-script')
<script>
    function changeSize(value){
        $('.stock-product').attr('hidden', true);
        $('.price-product').attr('hidden', true);
        // console.log(value);
        $('#stock'+value).removeAttr('hidden');
        $('#price'+value).removeAttr('hidden');
        // alert("waw");
    }
</script>
@endpush