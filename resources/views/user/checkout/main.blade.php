@extends('user.layout.app')

@section('content')
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Pembayaran</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Produk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
            </ol>
        </div>
    </nav>

    {{--  --}}
    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <form action="{{ route('userCheckoutProses') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-9">
                            <h2 class="checkout-title">Detail Pembayaran</h2>
                            <input type="hidden" name="id_user" value="{{ $user->id }}">
                            <input type="hidden" name="id_keranjang" value="{{ $keranjang->id_keranjang }}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Nama Lengkap *</label>
                                    <input type="text" name="nama_lengkap" class="form-control" readonly
                                        value="{{ $user->nama_lengkap }}">
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label>Username *</label>
                                    <input type="text" name="username" class="form-control" readonly
                                        value="{{ $user->username }}">
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->

                            <label>Alamat Lengkap *</label>
                            <textarea class="form-control" name="alamat_lengkap" cols="30" rows="5"
                                placeholder="Nama Jalan, Desa / Perkiraan" required>{{ $user->alamat_lengkap }}</textarea>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Provinsi *</label>
                                    <input type="text" name="provinsi" class="form-control" readonly
                                        value="{{ $provinsi->nama_provinsi }}">
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label>Kabupaten *</label>
                                    <input type="text" name="kabupaten" class="form-control" readonly
                                        value="{{ $kabupaten->nama_kabupaten }}">
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Kode Pos *</label>
                                    <input type="text" name="kode_pos" class="form-control" readonly
                                        value="{{ $user->kode_pos }}">
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label>No HP *</label>
                                    <input type="text" name="no_hp" class="form-control" readonly
                                        value="{{ $user->no_telp }}">
                                </div>
                            </div>
                            <label for="pengiriman">Pengiriman *</label>
                            <select name="ekspedisi" id="pengiriman" class="form-control" required>
                                <option value="">.:: Pilih Pengiriman ::.</option>
                                <option value="jne">JNE</option>
                                <option value="jnt">JNT</option>
                                <option value="pos">POS</option>
                            </select>

                            {{-- <label>Email *</label>
                            <input type="email" class="form-control" required> --}}

                            <label>Catatan Pembeli (opsional)</label>
                            <textarea class="form-control" cols="30" rows="4" placeholder="Catatan Pembeli" name="catatan_pembeli"></textarea>
                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-3">
                            <div class="summary">
                                <h3 class="summary-title">Detail Pesanan</h3>
                                <table class="table table-summary">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td><a href="#">{{ $produk->nama_produk }}</a></td>
                                            <td>{{ $produk->harga_produk }}</td>
                                        </tr>
                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>Rp. {{ $produk->harga_produk * $keranjang->qty }}</td>
                                        </tr><!-- End .summary-total -->
                                        {{-- <tr>
                                            <td>Shipping:</td>
                                            <td>Free shipping</td>
                                        </tr> --}}
                                    </tbody>
                                </table><!-- End .table table-summary -->

                                {{-- <div class="accordion-summary" id="accordion-payment">
                                    <div class="card">
                                        <div class="card-header" id="heading-1">
                                            <h2 class="card-title">
                                                <a role="button" data-toggle="collapse" href="#collapse-1"
                                                    aria-expanded="true" aria-controls="collapse-1">
                                                    Direct bank transfer
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse-1" class="collapse show" aria-labelledby="heading-1"
                                            data-parent="#accordion-payment">
                                            <div class="card-body">
                                                Make your payment directly into our bank account. Please use your Order ID
                                                as the payment reference. Your order will not be shipped until the funds
                                                have cleared in our account.
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                    <div class="card">
                                        <div class="card-header" id="heading-2">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse"
                                                    href="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                                    Check payments
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse-2" class="collapse" aria-labelledby="heading-2"
                                            data-parent="#accordion-payment">
                                            <div class="card-body">
                                                Ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque
                                                volutpat mattis eros. Nullam malesuada erat ut turpis.
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                    <div class="card">
                                        <div class="card-header" id="heading-3">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse"
                                                    href="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                                    Cash on delivery
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse-3" class="collapse" aria-labelledby="heading-3"
                                            data-parent="#accordion-payment">
                                            <div class="card-body">Quisque volutpat mattis eros. Lorem ipsum dolor sit
                                                amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis
                                                eros.
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                    <div class="card">
                                        <div class="card-header" id="heading-4">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse"
                                                    href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                                    PayPal <small class="float-right paypal-link">What is PayPal?</small>
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse-4" class="collapse" aria-labelledby="heading-4"
                                            data-parent="#accordion-payment">
                                            <div class="card-body">
                                                Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper
                                                suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum.
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                    <div class="card">
                                        <div class="card-header" id="heading-5">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse"
                                                    href="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                                    Credit Card (Stripe)
                                                    <img src="assets/images/payments-summary.png" alt="payments cards">
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse-5" class="collapse" aria-labelledby="heading-5"
                                            data-parent="#accordion-payment">
                                            <div class="card-body"> Donec nec justo eget felis facilisis fermentum.Lorem
                                                ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque
                                                volutpat mattis eros. Lorem ipsum dolor sit ame.
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->
                                </div><!-- End .accordion --> --}}

                                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                    <span class="btn-text">Bayar Sekarang</span>
                                    <span class="btn-hover-text">Proses Pesanan</span>
                                </button>
                            </div><!-- End .summary -->
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </form>
            </div><!-- End .container -->
        </div><!-- End .checkout -->
    </div><!-- End .page-content -->
@endsection
