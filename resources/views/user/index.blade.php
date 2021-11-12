@extends('template_frontend.home')
@section('content')
<!-- Hero section -->
<section class="hero-section">
    <div class="hero-slider owl-carousel">
        @foreach ($basket as $val)
        <div class="hs-item set-bg" data-setbg="{{ asset( $val->gambar) }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 text-white">
                        <span>New Arrivals</span>
                        <h2>Belanja produck</h2>
                        <p>
                            1. "Jajan mager, pasti hemat, harga merakyat".
                            2. "Solusi jajan simpel siswa"
                            3. "solusi agar tidak ngantri jajan"
                            4. "Jajan pasti mudah, murah, dan betah"
                            5. "Harganya hemat, isinya Mantaaap!!"
                            6. "Walaupun mager tapi perut jangan sampe laper
                            7."mempermudah hidup"
                        </p>
                        <a href="#" class="site-btn sb-line">DISCOVER</a>
                        <a href="{{ url('add-to-cart/'.$val->id) }}" class="site-btn sb-white">ADD TO PRODUK</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="container">
        <div class="slide-num-holder" id="snh-1"></div>
    </div>
</section>
<!-- Hero section end -->

<!-- letest product section -->
<section class="top-letest-product-section">
    <div class="container">
        <div class="section-title">
            <h2>LATEST PRODUCTS</h2>
        </div>
        <?php $no=0; ?>
        <div class="product-slider owl-carousel">
            @foreach ($basket as $val)
            <div class="product-item">
                <div class="pi-pic">
                    @if ($no == 0)
                    <div class="tag-new">New</div>
                    @else
                    @endif
                    <a href="{{ route('data.show', $val->id) }}"><img src="{{ asset( $val->gambar ) }}" alt=""></a>
                    <div class="pi-links">
                        <a href="{{ url('add-to-cart/'.$val->id) }}" class="add-card"><i
                                class="flaticon-bag"></i><span>PRODUK</span></a>
                        @if ($val->like($val->id))
                        <a href="{{ url('unlike/'.$val->id) }}" class="wishlist-btn"><i class="fa fa-heart"></i></a>
                        @else
                        <a href="{{ url('like/'.$val->id) }}" class="wishlist-btn"><i class="fa fa-heart-o"></i></a>
                        @endif
                    </div>
                </div>
                <div class="pi-text">
                    <h6><a href="{{ route('data.show', $val->id) }}">Rp. {{ number_format($val->price, 0) }}</a></h6>
                    <p><a href="{{ route('data.show', $val->id) }}">{{ $val->merek->name }} {{$val->type}}</a></p>
                </div>
            </div>
            <?php $no++ ?>
            @endforeach
        </div>
    </div>
</section>
<!-- letest product section end -->

<!-- Product filter section -->
<section class="product-filter-section">
    <div class="container">
        <div class="section-title">
            <h2>BROWSE TOP SELLING PRODUCTS</h2>
        </div>
        <?php $no=0; ?>
        <div class="row">
            @foreach ($data as $val)
            <div class="col-lg-3 col-sm-6">
                <div class="product-item">
                    <div class="pi-pic">
                        @if ($no == 0)
                        <div class="tag-new">New</div>
                        @else
                        @endif
                        <a href="{{ route('data.show', $val->id) }}"><img src="{{ asset( $val->gambar ) }}" alt=""></a>
                        <div class="pi-links">
                            <a href="{{ url('add-to-cart/'.$val->id) }}" class="add-card"><i
                                    class="flaticon-bag"></i><span>PRODUK</span></a>
                            @if ($val->like($val->id))
                            <a href="{{ url('unlike/'.$val->id) }}" class="wishlist-btn"><i class="fa fa-heart"></i></a>
                            @else
                            <a href="{{ url('like/'.$val->id) }}" class="wishlist-btn"><i class="fa fa-heart-o"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="pi-text">
                        <h6><a href="{{ route('data.show', $val->id) }}">Rp. {{ number_format($val->price, 0) }}</a>
                        </h6>
                        <p><a href="{{ route('data.show', $val->id) }}">{{ $val->merek->name }} {{$val->type}}</a></p>
                    </div>
                </div>
            </div>
            <?php $no++ ?>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-dark all-text-white pattern-overlay-4">
    <div class="container">
        <div class="col-md-12 col-lg-9 mx-auto p-4 p-sm-5">
            <div class="text-center px-0 px-sm-5">
                <h2 style="color: #ffffff;">A fantastic community!</h2>
				<br>
                <p class="mb-3 h6" style="color: #ffffff;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque iure dolores doloremque optio repellat error rerum, illum animi sequi voluptatem quaerat, labore in ipsam obcaecati molestiae itaque quo culpa cumque.</p>
            </div>
        </div>
    </div>
</section>
<br>
<br>
<section class="product-filter-section">
    <div class="container">
        <div class="section-title">
            <h2>Partners and sponsors</h2>
        </div>
        <div class="row text-center justify-content-center">
            <div class="col-4 col-md-2 mb-5">
                <a href="http://akademik.smkn1batam.sch.id/kksi2021" target="_blank">
                    <img class="gold-main-logo" src="{{ asset('login-form-05/images/kksi-sponsor.png') }}" title="KKSI"
                        width="100px">
                    <H3>KKSI</H3>
                </a>
            </div>
            <div class="col-4 col-md-2 mb-5">
                <a href="http://akademik.smkn1batam.sch.id/kksi2021" target="_blank">
                    <img class="gold-main-logo" src="{{ asset('login-form-05/images/LOGO_KKSI_5_BENDERA_KECIL.png') }}"
                        title="KKSI" width="100px">
                    <h3>Lima Bendera KKSI</h3>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
