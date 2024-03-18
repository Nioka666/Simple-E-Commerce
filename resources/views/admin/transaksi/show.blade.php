@extends('admin.layout.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data {{ $judul }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data {{ $judul }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Detail Data {{ $judul }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-striped">
                                                <tr>
                                                    <td>Kode Invoice</td>
                                                    <td><b>{{ ($transaksi->kode_invoice) ? $transaksi->kode_invoice : '-' }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Transaksi</td>
                                                    <td><b>{{ $transaksi->tanggal_transaksi ? $transaksi->tanggal_transaksi : '-' }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Status Transaksi</td>
                                                    <td><b>{{ $transaksi->status_transaksi ? $transaksi->status_transaksi : '-' }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Pembeli</td>
                                                    <td><b>{{ $transaksi->users->nama_lengkap ? $transaksi->users->nama_lengkap : '-' }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat Tujuan</td>
                                                    <td><b>PROVINSI
                                                            {{ $transaksi->provinsi->nama_provinsi ? $transaksi->provinsi->nama_provinsi : '-' }},
                                                            {{ $transaksi->kabupaten->nama_kabupaten ? $transaksi->kabupaten->nama_kabupaten : '-' }},
                                                            KODE POS
                                                            {{ $transaksi->kode_pos ? $transaksi->kode_pos : '-' }},
                                                            {{ $transaksi->alamat_lengkap ? $transaksi->alamat_lengkap : '-' }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal</td>
                                                    <td><b>{{ $transaksi->tanggal_transaksi ? $transaksi->tanggal_transaksi : '-' }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Ekspedisi</td>
                                                    <td><b>{{ $transaksi->ekspedisi ? $transaksi->ekspedisi : '-' }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Catatan Pembeli</td>
                                                    <td><b>{{ $transaksi->catatan_pembeli ? $transaksi->catatan_pembeli : '-' }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Total Jumlah Harga</td>
                                                    <td><b class="text-danger">Rp.
                                                            {{ $total_jumlah_transaksi ? number_format($total_jumlah_transaksi, 0, '.', ',') : '-' }}</b>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- list --}}
                                    <div class="col-lg-12">
                                        <h4>List Produk</h4>
                                        <div class="row">
                                            @foreach ($transaksi->transaksi_detail as $td)
                                                <div class="col-lg-6">
                                                    <div class="card">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <img src="{{ asset('template-admin/img/produk') }}/{{ $td->produk->foto_produk }}"
                                                                    class="w-100" alt="">
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="p-2">
                                                                    <h5>{{ $td->produk->nama_produk }} <span
                                                                            class="float-right text-danger"><b>Rp.
                                                                                {{ number_format($td->produk->harga_produk, 0, '.', ',') }}</b></span>
                                                                    </h5>
                                                                    <p>Qty ({{ $td->qty }}) x
                                                                        {{ number_format($td->qty * $td->produk->harga_produk, 0, '.', ',') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <a href="{{ route('transaksi') }}" class="btn btn-warning">Kembali</a>

                                    @if ($transaksi->status_transaksi == 'Pending' || $transaksi->status_transaksi == 'Selesai')
                                        <a href="{{ route('transaksiTolak', $transaksi->id_transaksi) }}"
                                            class="btn btn-danger"
                                            onclick="return confirm('Apakah anda ingin menolak transaksi ini?')">Tolak</a>

                                        @if ($transaksi->status_transaksi == 'Pending')
                                            <a href="{{ route('transaksiProses', $transaksi->id_transaksi) }}"
                                                class="btn btn-primary float-right mr-2"
                                                onclick="return confirm('Apakah anda ingin memproses transaksi ini?')">Proses</a>
                                        @endif

                                    @elseif ($transaksi->status_transaksi == 'Proses Admin')
                                        <a href="{{ route('transaksiKirim', $transaksi->id_transaksi) }}"
                                            class="btn btn-warning float-right"
                                            onclick="return confirm('Apakah anda ingin mengirim Transaksi ini?')">Kirim</a>

                                    @elseif ($transaksi->status_transaksi == 'Pengiriman')
                                        <a href="{{ route('transaksiSelesai', $transaksi->id_transaksi) }}"
                                            class="btn btn-success float-right"
                                            onclick="return confirm('Apakah anda ingin menyelesaikan Transaksi ini?')">Selesai</a>
                                    @endif
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
@endsection
