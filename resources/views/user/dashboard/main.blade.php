@extends('user.layout.app')

@section('content')
<div class="container">
    <div class="intro-slider-container slider-container-ratio mb-2">
        <div class="intro-slider owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl"
            data-owl-options='{"nav": false}'>
            <div class="intro-slide">
                <figure class="slide-image">
                    <picture>
                        <source media="(max-width: 480px)"
                            srcset="template-user/assets/images/demos/demo-10/slider/chu.jpg')}}">
                        <img src="{{ 'template-user/assets/images/demos/demo-10/slider/chu.jpg' }}" alt="Image Desc">
                    </picture>
                </figure>

                <div class="intro-content">
                    <h3 class="intro-subtitle">Deals and Promotions</h3><!-- End .h3 intro-subtitle -->
                    <h1 class="intro-title text-white">Moondrop Esclusive Series</h1><!-- End .intro-title -->

                    <div class="intro-price text-white">from $9.99</div><!-- End .intro-price -->

                    <a href="category.html" class="btn btn-white-primary btn-round">
                        <span>SHOP NOW</span>
                        <i class="icon-long-arrow-right"></i>
                    </a>
                </div><!-- End .intro-content -->
            </div><!-- End .intro-slide -->

            <div class="intro-slide">
                <figure class="slide-image">
                    <picture>
                        <source media="(max-width: 480px)"
                            srcset="template-user/assets/images/demos/demo-10/slider/kato.jpg')}}">
                        <img src="{{ 'template-user/assets/images/demos/demo-10/slider/kato.jpg' }}" alt="Image Desc">
                    </picture>
                </figure><!-- End .slide-image -->

                <div class="intro-content">
                    <h3 class="intro-subtitle">Trending Now</h3><!-- End .h3 intro-subtitle -->
                    <h1 class="intro-title text-white">This Week's Most Wanted</h1><!-- End .intro-title -->

                    <div class="intro-price text-white">from $49.99</div><!-- End .intro-price -->

                    <a href="category.html" class="btn btn-white-primary btn-round">
                        <span>SHOP NOW</span>
                        <i class="icon-long-arrow-right"></i>
                    </a>
                </div><!-- End .intro-content -->
            </div><!-- End .intro-slide -->

            <div class="intro-slide">
                <figure class="slide-image">
                    <picture>
                        <source media="(max-width: 480px)"
                            srcset="template-user/assets/images/demos/demo-10/slider/melody.jpg')}}">
                        <img src="{{ 'template-user/assets/images/demos/demo-10/slider/melody.jpg' }}" alt="Image Desc">
                    </picture>
                </figure><!-- End .slide-image -->

                <div class="intro-content">
                    <h3 class="intro-subtitle text-white">Deals and Promotions</h3><!-- End .h3 intro-subtitle -->
                    <h1 class="intro-title text-white">Can’t-miss Clearance:</h1><!-- End .intro-title -->

                    <div class="intro-price text-white">starting at 60% off</div><!-- End .intro-price -->

                    <a href="category.html" class="btn btn-white-primary btn-round">
                        <span>SHOP NOW</span>
                        <i class="icon-long-arrow-right"></i>
                    </a>
                </div><!-- End .intro-content -->
            </div><!-- End .intro-slide -->
        </div><!-- End .intro-slider owl-carousel owl-simple -->
        <span class="slider-loader"></span><!-- End .slider-loader -->
    </div><!-- End .intro-slider-container -->
</div><!-- End .container -->
<div class="mb-4"></div>
<div class="container">
    <div class="heading heading-center mb-3">
        {{-- categories --}}
        <h2 class="title-lg mb-2">PENJUALAN PRODUK TERATAS</h2>
        <!-- End .title-lg text-center -->
        <ul class="nav nav-pills justify-content-center" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab" role="tab"
                    aria-controls="top-all-tab" aria-selected="true">All</a>
            </li>
            @foreach ($kategori_produk as $kp)
            <li class="nav-item">
                <a class="nav-link" id="top-{{ $kp->id_kategori_produk }}-link" data-toggle="tab"
                    href="#top-{{ $kp->id_kategori_produk }}-tab" role="tab"
                    aria-controls="top-{{ $kp->id_kategori_produk }}-tab" aria-selected="false">{{
                    $kp->nama_kategori_produk }}</a>
            </li>
            @endforeach
        </ul>
    </div>
    <!-- End .heading -->

    <div class="tab-content">
        <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
            <div class="products just-action-icons-sm">
                <div class="row">
                    {{-- row --}}
                    @foreach ($produk as $p)
                    <div class="col-6 col-md-4 col-lg-3 col-xl-6col">
                        <div class="product product-3 text-center">
                            <figure class="product-media" style="">
                                <span class="product-label label-primary">New</span>
                                <a href="product.html">
                                    <img src="{{ asset('template-admin/img/produk/' . $p->foto_produk) }}"
                                        style="height: 285px" width="300px">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add
                                            to wishlist</span></a>
                                </div>
                            </figure>

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">{{ $p->kategori_produk->nama_kategori_produk }}</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">{{ $p->nama_produk }}</a></h3>
                                <div class="product-price">
                                    Rp. {{ $p->harga_produk }}
                                </div>
                            </div><!-- End .product-body -->

                            <div class="product-footer">
                                <div class="ratings-container">
                                    <span class="ratings-text">Stok : {{ $p->stok_produk }}</span>
                                </div><!-- End .rating-container -->

                                <form action="{{ route('userAddToCart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $p->id_produk }}">
                                    <button type="submit" class="btn btn-primary mb-1">Tambah ke keranjang
                                    </button>
                                </form>
                                <a href="{{ route('userProduk', $p->slug_produk) }}" class="btn btn-success">Detail
                                    Produk</a>
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add
                                            to cart</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                        title="Quick view"><span>quick view</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @foreach ($kategori_produk as $kp)
        <div class="tab-pane p-0 fade" id="top-{{ $kp->id_kategori_produk }}-tab" role="tabpanel"
            aria-labelledby="top-women-link">
            <div class="products just-action-icons-sm">
                <div class="row">
                    @foreach ($kp->produk as $p)
                    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                        <div class="product product-3 text-center">
                            <figure class="product-media">
                                <span class="product-label label-primary">New</span>
                                <a href="product.html">
                                    <img src="{{ 'template-admin/img/produk/' . $p->foto_produk }}" alt="Product image"
                                        class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add
                                            to
                                            wishlist</span></a>
                                </div><!-- End .product-action-vertical -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">{{ $p->kategori_produk->nama_kategori_produk }}</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">{{ $p->nama_produk }}</a>
                                </h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    Rp {{ $p->harga_produk }}
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->

                            <div class="product-footer">
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 40%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 7 Reviews )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add
                                            to cart</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                        title="Quick view"><span>quick view</span></a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-footer -->
                        </div><!-- End .product -->
                    </div><!-- End .col-6 col-md-4 col-lg-3 -->
                    @endforeach
                </div><!-- End .row -->
            </div><!-- End .products -->
        </div><!-- .End .tab-pane -->
        @endforeach
    </div><!-- End .tab-content -->
</div><!-- End .container -->

<div class="mb-5"></div><!-- End .mb5 -->
{{--
</main> --}}
@endsection
