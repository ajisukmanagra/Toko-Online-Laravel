@extends('template_frontend.home')
@section('css')
<link type="text/css" rel="stylesheet" href="http://localhost/blog/public/css/style.css" />
@endsection
@section('content')
<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4>Pembayaran</h4>
        <div class="site-pagination">
            <a href="{{ route('home') }}">Home</a> /
            <a href="#">Pembayaran</a>
        </div>
    </div>
</div>
<!-- Page info end -->

<!-- checkout section  -->
<section class="section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 order-2 order-lg-1">
                <form class="checkout-form" method="post" action="{{ route('proses_pembayaran', $order->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="cf-title">Billing Address</div>
                    <div class="row address-inputs justify-content-center">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Nama Pesanan</label>
                                <input type="text" name="namaBank" placeholder="Nama Pesanan" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Nama Pemesan</label>
                                <input type="text" name="namaPengirim" placeholder="Nama Pemesan" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>foto Pemesan Produck</label><br>
                                <input type="file" name="gambar">
                            </div>
                        </div>
                    </div>
                    <button class="site-btn submit-order-btn">Continue</button>
                </form>
            </div>
            <div class="col-lg-4 order-1 order-lg-2">
                <div class="checkout-cart mb-5">
                    <ul class="price-list">
                        <li>Sub Total<span style="width: 120px;">Rp. {{ number_format($order->total, 0) }}</span></li>
                        <li>PPN<span style="width: 120px;">10%</span></li>
                        @php
                        $order->total += ($order->total * 10 / 100)
                        @endphp
                        <li class="total">Total<span style="width: 120px;">Rp.
                                {{ number_format($order->total, 0) }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- checkout section end -->
@endsection
