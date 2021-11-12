@extends('template_frontend.home')
@section('content')
  	<!-- Product filter section -->
  	<section class="product-filter-section mt-5">
  		<div class="container">
  			<div class="section-title">
  				<h2>FAVORITE PRODUCTS</h2>
  			</div>
  			<div class="row">
          		@foreach ($like as $data)
    				<div class="col-lg-3 col-sm-6">
    					<div class="product-item">
    						<div class="pi-pic">
                                @if ($data->data->id == $new->id)
                                    <div class="tag-new">Baru</div>
                                @else
                                @endif
                  				<a href="{{ route('data.show', $data->data->id) }}"><img src="{{ asset( $data->data->gambar ) }}" alt=""></a>
    							<div class="pi-links">
									<a href="{{ url('add-to-cart/'.$data->data->id) }}" class="add-card"><i class="flaticon-bag"></i><span>PRODUK</span></a>
									@if ($data->data->like($data->data->id))
										<a href="{{ url('unlike/'.$data->data->id) }}" class="wishlist-btn"><i class="fa fa-heart"></i></a>
									@else
										<a href="{{ url('like/'.$data->data->id) }}" class="wishlist-btn"><i class="fa fa-heart-o"></i></a>
									@endif
    							</div>
    						</div>
    						<div class="pi-text">
                  				<h6><a href="{{ route('data.show', $data->data->id) }}">Rp. {{ number_format($data->data->price, 0) }}</a></h6>
      							<p><a href="{{ route('data.show', $data->data->id) }}">{{ $data->data->merek->name }} {{$data->data->type}}</a></p>
    						</div>
    					</div>
    				</div>
          		@endforeach
  			</div>
  		</div>
  	</section>
  	<!-- Product filter section end -->
@endsection
