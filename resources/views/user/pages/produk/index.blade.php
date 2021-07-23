@extends('user.layouts.default')

@section('content')
 

		<!-- Product Style -->
		<section class="product-area shop-sidebar shop section">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-4 col-12">
						<div class="shop-sidebar">
								<!-- Single Widget -->
								<div class="single-widget category">
									<h3 class="title">Kategori</h3>
									<ul class="categor-list">
										<li><a href="{{ route('user.produk') }}">Semua</a></li>
										@foreach ($category as $item)
											<li><a href="{{ route('user.produk-category', $item->slug) }}">{{ $item->name }}</a></li>
										@endforeach
									</ul>
								</div>
							
						</div>
					</div>
					<div class="col-lg-9 col-md-8 col-12">
						<div class="row">
							@foreach ($data as $item)
							  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
								<div class="single-product">
								  <div class="product-img">
									<a href="{{ route('user.produk-detail', $item->slug) }}">
									  <img class="default-img" src="{{ asset($item->images->first()->dir_photo) }}" alt="#">
									</a>
									
								  </div>
								  <div class="product-content">
									<h3><a href="{{ route('user.produk-detail', $item->slug) }}">{{ $item->name }}</a></h3>
									<div class="product-price">
									  <span>Rp. {{ $item->detail->first()->price }}</span>
									</div>
								  </div>
								</div>
							  </div>
							@endforeach
							
						  </div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Product Style 1  -->	

	
@endsection

@push('after-script')
@endpush