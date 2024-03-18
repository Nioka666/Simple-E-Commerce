<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UP-SKANEDA</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template-admin/plugins/fontawesome-free/css/all.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template-admin/dist/css/adminlte.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('template-admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    {{-- Toastr --}}
    <link rel="stylesheet" href="{{ asset('template-admin/plugins/toastr/toastr.min.css') }}">
    {{-- Toastr --}}
    <link rel="stylesheet" href="{{ asset('template-admin/plugins/toastr/toastr.min.css') }}">
    {{-- bootstrap icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    {{-- Data Tables --}}
    <link rel="stylesheet"
        href="{{ asset('template-admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template-admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template-admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
</head>

<body>
    <table id="tabel-data" class="table table-bordered table-striped table-responsive">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Kode Invoice</th>
                <th>Nama Pembeli</th>
                <th>Produk</th>
                <th>QTY</th>
                <th>Tanggal Transaksi</th>
                <th>Status Transaksi</th>
                <th>Alamat Tujuan</th>
                <th>Ekspedisi</th>
                <th>Catatan Pembeli</th>
                {{-- <th>Aksi</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan_penjualan as $key => $lp)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $lp->kode_transaksi }}</td>
                    <td>{{ $lp->kode_invoice }}</td>
                    <td>{{ $lp->users->nama_lengkap }} </td>
                    <td>
                        <ol>
                            @foreach ($lp->transaksi_detail as $td)
                                <li>{{ $td->produk->nama_produk }}</li>
                            @endforeach
                        </ol>
                        {{-- <a href="{{ route('transaksiShow', $lp->id_transaksi) }}"
                        class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></a> --}}
                        {{-- <a href="{{ route('transaksiEdit', $lp->id_transaksi) }}"
                        class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>

                    <a onclick="return confirm('Apakah anda ingin menghapus Data?')"
                        href="{{ route('transaksiDelete', $lp->id_transaksi) }}"
                        class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> --}}
                    </td>
                    <td>
                        <ul>
                            @foreach ($lp->transaksi_detail as $td)
                                <li>{{ $td->qty }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $lp->tanggal_transaksi }}</td>
                    <td>{{ $lp->status_transaksi }}</td>
                    <td>
                        PROVINSI {{ $lp->provinsi->nama_provinsi ? $lp->provinsi->nama_provinsi : '-' }},
                        {{ $lp->kabupaten->nama_kabupaten ? $lp->kabupaten->nama_kabupaten : '-' }}, KODE POS
                        {{ $lp->kode_pos ? $lp->kode_pos : '-' }},
                        {{ $lp->alamat_lengkap ? $lp->alamat_lengkap : '-' }}
                    </td>
                    <td>{{ $lp->ekspedisi }}</td>
                    <td>{{ $lp->catatan_pembeli }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Kode Invoice</th>
                <th>Nama Pembeli</th>
                <th>Produk</th>
                <th>QTY</th>
                <th>Tanggal Transaksi</th>
                <th>Status Transaksi</th>
                <th>Alamat Tujuan</th>
                <th>Ekspedisi</th>
                <th>Catatan Pembeli</th>
            </tr>
        </tfoot>
    </table>

    <script>
        window.print()
        window.onfocus=function(){
            window.close()
        }
    </script>
</body>
