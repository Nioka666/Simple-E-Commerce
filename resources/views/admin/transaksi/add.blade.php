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
                                <h3 class="card-title">Form Tambah Data {{ $judul }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('transaksiStore') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="user_id">Pilih Pembeli</label>
                                        <select name="user_id" id="user_id" class="form-control" required>
                                            <option value="">.:: Pilih Pembeli ::.</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->nama_lengkap }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="produk_id">Pilih Produk</label>
                                        <select name="produk_id" id="produk_id" class="form-control" required>
                                            <option value="">.:: Pilih Produk ::.</option>
                                            @foreach ($produk as $p)
                                                <option value="{{ $p->id_produk }}">{{ $p->nama_produk }}({{ $p->kategori_produk->nama_kategori_produk }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_transaksi">Tanggal Transaksi</label>
                                        <input type="date" name="tanggal_transaksi" value="{{ date('Y-m-d') }}" class="form-control" id="tanggal_transaksi" placeholder="Masukkan Tanggal Transaksi" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="ekspedisi">Pilih Expedisi</label>
                                        <select name="ekspedisi" id="ekspedisi" class="form-control" required>
                                            <option value="">.:: Pilih Ekspedisi ::.</option>
                                            <option value="JNE">JNE</option>
                                            <option value="JNT">JNT</option>
                                            <option value="POS">POS</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="catatan_pembeli">Catatan Pembeli</label>
                                        <textarea name="catatan_pembeli" id="catatan_pembeli" class="form-control" cols="30" rows="5" placeholder="Catatan Pembeli">{{ old('catatan_pembeli') }}</textarea>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('transaksi') }}" class="btn btn-warning">Kembali</a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.row -->
                </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')

@endsection
