@extends('user.layout.app')

@section('content')
<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ asset('template-user/assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">Wishlist<span>Shop</span></h1>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <table class="table table-wishlist table-mobile">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Total Harga</th>
                        <th>Status Checkout</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($transaksi) > 0)
                    @foreach ($transaksi as $trx)
                    <tr>
                        <td class="product-col">
                            <div class="product">
                                <figure class="product-media">
                                    <a href="#">
                                        <img src="{{ asset('template-admin/img/produk/' . $trx->transaksi_detail[0]->produk->foto_produk) }}"
                                            alt="Product image">
                                    </a>
                                </figure>

                                <h3 class="product-title">
                                    <a href="#">{{ $trx->transaksi_detail[0]->produk->nama_produk }}</a>
                                </h3><!-- End .product-title -->
                            </div><!-- End .product -->
                        </td>
                        <td class="price-col">{{ $trx->transaksi_detail[0]->produk->harga_produk *
                            $trx->transaksi_detail[0]->qty }}</td>
                        <td class="stock-col"><span class="in-stock">{{ $trx->status_transaksi }}</span></td>
                        <td class="action-col">
                            @if ($trx->status_transaksi == 'Pengiriman')
                            <form action="{{ route('userCheckoutComplete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $trx->id_transaksi }}">
                                <button class="btn btn-block btn-outline-success" type="submit">
                                    <i class="icon-check"></i>Ubah Menjadi Selesai
                                </button>
                            </form>
                            @else
                            Tidak ada isi
                            @endif
                            {{-- <div class="dropdown">
                                <button class="btn btn-block btn-outline-primary-2" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-list-alt"></i>Select Options
                                </button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">First option</a>
                                    <a class="dropdown-item" href="#">Another option</a>
                                    <a class="dropdown-item" href="#">The best option</a>
                                </div>
                            </div> --}}
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="4">Tidak ada data</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection
