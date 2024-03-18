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
            </div>
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
                                <h3 class="card-title">Form Detail Data{{ $judul }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama_lengkap"
                                            placeholder="Nama Lengkap" name="nama_lengkap"
                                            value="{{ old('nama_lengkap') ? old('nama_lengkap') : $users->nama_lengkap }}"
                                            required disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username"
                                            placeholder="Masukkan Username"
                                            value="{{ old('username') ? old('username') : $users->username }}"
                                            name="username" required disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Masukkan Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            value="{{ old('email') ? old('email') : $users->email }}"
                                            placeholder="Masukkan email" value="{{ old('email') }}" required disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telp">Nomor telepon</label>
                                        <input type="number" class="form-control" id="no_telp" name="no_telp"
                                            placeholder="Masukkan No Telepon"
                                            value="{{ old('no_telp') ? old('no_telp') : $users->no_telp }}" required
                                            disabled>
                                    </div>
                                    {{-- provinsi --}}
                                    <div class="form-group">
                                        <label for="provinsi">Provinsi</label>
                                        <select name="provinsi" id="provinsi" class="form-control"
                                            onchange="getKabupaten()" disabled>
                                            <option value="">.:: Pilih Provinsi ::.</option>
                                            @foreach ($provinsi as $prov)
                                                <option value="{{ $prov->id_provinsi }} "
                                                    {{ $prov->id_provinsi == $users->provinsi_id ? 'selected' : '' }}>
                                                    {{ $prov->nama_provinsi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- kabupaten --}}
                                    <div class="form-group">
                                        <label for="kabupaten">Kabupaten</label>
                                        <select name="kabupaten" id="kabupaten" class="form-control" disabled>
                                            <option value="">.:: Pilih Kabupaten ::.</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="kode_pos">Kode Pos</label>
                                        <input type="text" name="kode_pos" class="form-control" id="kode_pos"
                                            value="{{ old('kode_pos') ? old('kode_pos') : $users->kode_pos }}"
                                            placeholder="Masukkan Kode Pos" disabled required>
                                    </div>
                                    {{-- alamat lengkap !! --}}
                                    <div class="form-group">
                                        <label for="alamat_lengkap">Alamat Lengkap</label>
                                        <textarea name="alamat_lengkap" class="form-control" id="alamat_lengkap" placeholder="Masukkan Alamat Lengkap"
                                            cols="30" rows="5" disabled>{{ old('alamat_lengkap') ? old('alamat_lengkap') : $users->alamat_lengkap }}</textarea>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    {{-- <button type="submit" class="btn btn-primary">Simpan</button> --}}
                                    <a href="{{ route('users') }}" class="btn btn-warning">Kembali</a>
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
@endsection
@section('script')
    <script>
        $(document).ready(() => {
            getKabupaten()
        })

        function getKabupaten() {
            let id_provinsi = $("#provinsi").val();
            if (id_provinsi) {
                $.post("{{ route('usersGetKabupaten') }}", {
                    id_provinsi: id_provinsi
                }).done((data) => {
                    if (data.status == 'success') {
                        let html = `<option value="">.:: Pilih Kabupaten ::. </option>`
                        data.data.forEach((v, i) => {
                            html +=
                                `<option value="${v.id_kabupaten} " ${(v.id_kabupaten == '{{ $users->kabupaten_id }}') ? 'selected' : ''}>${ v.nama_kabupaten }</option>`
                        });

                        $("#kabupaten").html(html)
                        console.log(html)
                    } else {
                        toastr.error(`${data.message}`);
                    }
                });
            } else {
                toastr.error('Provinsi tidak boleh kosong');
            }
        }
    </script>
@endsection
