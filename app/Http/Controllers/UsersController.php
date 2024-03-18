<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Provinsi;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    protected $judul = 'Users';
    protected $menu = 'datamaster';
    protected $sub_menu = 'users';
    protected $direktori = 'admin.datamaster.users';

    public function index()
    {
        if (Auth::user()->level_user !== 'Admin' ) {
            return redirect()->route('userDashboard')->with('status', 'error')->with('message', 'anda bukan seorang admin!');
        }

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['users'] = Users::where('level_user', 'Pengguna')->get();

        return view($this->direktori . '.main', $data);
    }

    public function create()
    {
        $data = [
            'judul' => $this->judul,
            'menu' => $this->menu,
            'sub_menu' => $this->sub_menu,
            'provinsi' => Provinsi::all(),
        ];

        return view($this->direktori . '.add', $data);
    }

    public function store(Request $request)
    {
        $nama_lengkap = $request->nama_lengkap;
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $no_telp = $request->no_telp;
        $provinsi_id = $request->provinsi;
        $kabupaten_id = $request->kabupaten;
        $kode_pos = $request->kode_pos;
        $alamat_lengkap = $request->alamat_lengkap;

        if (empty($nama_lengkap)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Nama Lengkap harus diisi'); // !!!
        }
        if (empty($username)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Username harus diisi'); // !!!
        }
        if (empty($email)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Email Lengkap harus diisi'); // !!!
        }
        if (empty($password)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Password Lengkap harus diisi'); // !!!
        }
        if (empty($no_telp)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Nomor Telepon harus diisi'); // !!!
        }
        if (empty($provinsi_id)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Provinsi Lengkap harus diisi'); // !!!
        }
        if (empty($kabupaten_id)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Kabupaten Lengkap harus diisi'); // !!!
        }
        if (empty($kode_pos)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Kode Pos harus diisi'); // !!!
        }
        if (empty($alamat_lengkap)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Alamat Lengkap Lengkap harus diisi'); // !!!
        }

        $cek_username = Users::where('username', $username)->first();
        $cek_email = Users::where('email', $email)->first();

        if (!empty($cek_username)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Username sudah terdaftar pada sistem');
        }
        if (!empty($cek_email)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Email sudah terdaftar pada sistem');
        }

        // Simpan
        $users = new Users();
        $users->nama_lengkap = $nama_lengkap;
        $users->username = $username;
        $users->email = $email;
        $users->password = Hash::make($password);
        $users->no_telp = $no_telp;
        $users->provinsi_id = $provinsi_id;
        $users->kabupaten_id = $kabupaten_id;
        $users->kode_pos = $kode_pos;
        $users->alamat_lengkap = $alamat_lengkap;
        $users->level_user = 'Pengguna';
        $users->save();

        if ($users) {
            return redirect()->route('users')->with('status', 'success')->with('message', 'Berhasil menyimpan data');
        } else {
            return back()->withInput()->with('status', 'error')->with('message', 'Gagal menyimpan data');
        }
    }

    public function show($id)
    {
        $data = [
            'judul' => $this->judul,
            'menu' => $this->menu,
            'sub_menu' => $this->sub_menu,
            'provinsi' => Provinsi::all(),
            'users' => Users::where('id', $id)->first()
        ];

        return view($this->direktori . '.show', $data);
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'judul' => $this->judul,
            'menu' => $this->menu,
            'sub_menu' => $this->sub_menu,
            'provinsi' => Provinsi::all(),
            'users' => Users::where('id', $id)->first()
        ];

        return view($this->direktori . '.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nama_lengkap = $request->nama_lengkap;
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $no_telp = $request->no_telp;
        $provinsi_id = $request->provinsi;
        $kabupaten_id = $request->kabupaten;
        $kode_pos = $request->kode_pos;
        $alamat_lengkap = $request->alamat_lengkap;

        if (empty($nama_lengkap)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Nama Lengkap harus diisi'); // !!!
        }
        if (empty($username)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Username harus diisi'); // !!!
        }
        if (empty($email)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Email Lengkap harus diisi'); // !!!
        }
        if (empty($no_telp)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Nomor Telepon harus diisi'); // !!!
        }
        if (empty($provinsi_id)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Provinsi Lengkap harus diisi'); // !!!
        }
        if (empty($kabupaten_id)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Kabupaten Lengkap harus diisi'); // !!!
        }
        if (empty($kode_pos)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Kode Pos harus diisi'); // !!!
        }
        if (empty($alamat_lengkap)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Alamat Lengkap Lengkap harus diisi'); // !!!
        }

        $cek_username = Users::where('username', $username)->where('id', '!=', $id)->first();
        $cek_email = Users::where('email', $email)->where('id', '!=', $id)->first();

        if (!empty($cek_username)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Username sudah terdaftar pada sistem');
            # code...
        }
        if (!empty($cek_email)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Email sudah terdaftar pada sistem');
            # code...
        }

        // Simpan

        $users = Users::where('id', $id)->first();
        $users->nama_lengkap = $nama_lengkap;
        $users->username = $username;
        $users->email = $email;
        if (!empty($password)) {
            $users->password = Hash::make($password);
        }
        // $users->password = Hash::make($password);
        $users->no_telp = $no_telp;
        $users->provinsi_id = $provinsi_id;
        $users->kabupaten_id = $kabupaten_id;
        $users->kode_pos = $kode_pos;
        $users->alamat_lengkap = $alamat_lengkap;
        $users->level_user = 'Pengguna';
        $users->save();

        if ($users) {
            return redirect()->route('users')->with('status', 'success')->with('message', 'Berhasil mengubah data');
        } else {
            return back()->withInput()->with('status', 'error')->with('message', 'Gagal menyimpan data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = Users::where('id', $id)->first();
        if (!empty($users)) {
            $users->delete();

            return redirect()->route('users')->with('status', 'success')->with('message', 'Berhasil menghapus data');
        } else {
            return redirect()->route('users')->with('status', 'success')->with('message', 'Gagal menghapus data');
        }
    }

    public function getKabupaten(Request $request)
    {
        $kabupaten = Kabupaten::where('id_provinsi', $request->id_provinsi)->get();

        if ($kabupaten->count() > 0) {
            return ['status' => 'success', 'code' => 200, 'message' => 'Berhasil mengambil data', 'data' => $kabupaten];
        } else {
            return ['status' => 'error', 'code' => 500, 'message' => 'Gagal mengambil data', 'data' => $kabupaten];
        }
    }
}
