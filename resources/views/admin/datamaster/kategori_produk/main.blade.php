@extends('admin.layout.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $judul }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $judul }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <a href="{{ route('kategoriProdukCreate') }}" class="btn btn-primary mb-3">Tambah Data
                                    {{ $judul }}</a>
                                <table id="tabel-data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kategori Produk</th>
                                            <th>Slug Kategori Produk</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kategori_produk as $key => $kp)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $kp->nama_kategori_produk }}</td>
                                                <td>{{ $kp->slug_kategori_produk }}</td>
                                                <td>
                                                    <a href="{{ route('kategoriProdukShow', $kp->id_kategori_produk) }}"
                                                        class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></a>
                                                    <a href="{{ route('kategoriProdukEdit', $kp->id_kategori_produk) }}"
                                                        class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>

                                                    <a onclick="return confirm('Apakah anda ingin menghapus Data?')"
                                                        href="{{ route('kategoriProdukDelete', $kp->id_kategori_produk) }}"
                                                        class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kategori Produk</th>
                                            <th>Slug Kategori Produk</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
    <script>
        $('#tabel-data').DataTable();
    </script>
@endsection
