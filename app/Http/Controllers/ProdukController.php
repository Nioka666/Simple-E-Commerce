<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use App\Models\KategoriProduk;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $judul = 'Produk';
    protected $menu = 'datamaster';
    protected $sub_menu = 'produk';
    protected $direktori = 'admin.datamaster.produk';

    public function index()
    {
        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['produk'] = Produk::with(['kategori_produk'])->orderBy('created_at', 'DESC')->get();

        return view($this->direktori . '.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'judul' => $this->judul,
            'menu' => $this->menu,
            'sub_menu' => $this->sub_menu,
            'kategori_produk' => KategoriProduk::all()
        ];

        return view($this->direktori . '.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama_produk = $request->nama_produk;
        $id_kategori_produk = $request->id_kategori_produk;
        $stok_produk = $request->stok_produk;
        $berat_produk = $request->berat_produk;
        $harga_produk = $request->harga_produk;
        $deskripsi_produk = $request->deskripsi_produk;
        $foto_produk = $request->foto_produk;

        if (empty($nama_produk)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Nama Produk harus diisi'); // !!!
        }
        if (empty($id_kategori_produk)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Kategori Produk harus diisi'); // !!!
        }
        if (empty($stok_produk)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Stok Produk harus diisi'); // !!!
        }
        if (empty($berat_produk)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Berat Produk harus diisi'); // !!!
        }
        if (empty($harga_produk)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Harga Produk harus diisi'); // !!!
        }
        if (empty($deskripsi_produk)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Deskripsi Produk harus diisi'); // !!!
        }
        if (empty($foto_produk)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Foto Produk harus diisi file'); // !!!
        }

        // Simpan
        // instansiasi object / eloquent baru
        $produk = new Produk();
        $produk->nama_produk = $nama_produk;
        $produk->slug_produk = Str::slug($nama_produk);
        $produk->kategori_produk_id = $id_kategori_produk;
        $produk->stok_produk = $stok_produk;
        $produk->berat_produk = $berat_produk;
        $produk->harga_produk = $harga_produk;
        $produk->deskripsi_produk = $deskripsi_produk;

        $nama_foto = str_replace([' ', '/'], '-', $nama_produk);
        $ext_foto = $foto_produk->getClientOriginalExtension();
        $filename = $nama_foto . '-' . date('Ymdhis') . '.' . $ext_foto;
        $temp_foto = 'template-admin/img/produk';
        $proses = $foto_produk->move($temp_foto, $filename);

        $produk->foto_produk = $filename;
        // $produk->slug_kategori_produk = Str::slug($nama_kategori_produk);
        $produk->save();

        if ($produk) {
            return redirect()->route('produk')->with('status', 'success')->with('message', 'Berhasil menyimpan data');
        } else {
            return back()->withInput()->with('status', 'error')->with('message', 'Gagal menyimpan data');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'judul' => $this->judul,
            'menu' => $this->menu,
            'sub_menu' => $this->sub_menu,
            'kategori_produk' => KategoriProduk::all(),
            'produk' => Produk::where('id_produk', $id)->first()
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
            'kategori_produk' => KategoriProduk::all(),
            'produk' => Produk::where('id_produk', $id)->first()
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
        $nama_produk = $request->nama_produk;
        $id_kategori_produk = $request->id_kategori_produk;
        $stok_produk = $request->stok_produk;
        $berat_produk = $request->berat_produk;
        $harga_produk = $request->harga_produk;
        $deskripsi_produk = $request->deskripsi_produk;
        $foto_produk = $request->foto_produk;

        if (empty($nama_produk)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Nama Produk harus diisi'); // !!!
        }
        if (empty($id_kategori_produk)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Kategori Produk harus diisi'); // !!!
        }
        if (empty($stok_produk)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Stok Produk harus diisi'); // !!!
        }
        if (empty($berat_produk)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Berat Produk harus diisi'); // !!!
        }
        if (empty($harga_produk)) {
            return response()->back()->withInput()->with('status', 'error')->with('message', 'Kolom Harga Produk harus diisi'); // !!!
        }
        if (empty($deskripsi_produk)) {
            return response()->back()->withInput()->with('status', 'error')->with('message', 'Kolom Deskripsi Produk harus diisi'); // !!!
        }
        // // cek
        // $cek_kp = Produk::where('nama_kategori_produk', $nama_kategori_produk)->first();

        // if (!empty($cek_kp)) {
        //     return back()->withInput()->with('status', 'error')->with('message', 'Kategori Produk sudah terdaftar pada sistem');
        // }

        // Simpan
        // instansiasi object / eloquent baru
        $produk = Produk::where('id_produk', $id)->first();
        $produk->nama_produk = $nama_produk;
        $produk->slug_produk = Str::slug($nama_produk);
        $produk->kategori_produk_id = $id_kategori_produk;
        $produk->stok_produk = $stok_produk;
        $produk->berat_produk = $berat_produk;
        $produk->harga_produk = $harga_produk;
        $produk->deskripsi_produk = $deskripsi_produk;

        if (isset($foto_produk)) {
            if (!empty($foto_produk) && $foto_produk != '0') {
                if (!empty($produk) && $produk->foto_produk != '') {
                    $path = 'template-admin/img/produk' . $produk->foto_produk;
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                $nama_foto = str_replace([' ', '/'], '-', $nama_produk);
                $ext_foto = $foto_produk->getClientOriginalExtension();
                $filename = $nama_foto . '-' . date('Ymdhis') . '.' . $ext_foto;
                $temp_foto = 'template-admin/img/produk';
                $proses = $foto_produk->move($temp_foto, $filename);

                $produk->foto_produk = $filename;
            }
        }
        $produk->save();

        if ($produk) {
            return redirect()->route('produk')->with('status', 'success')->with('message', 'Berhasil menyimpan data');
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
        $produk = Produk::where('id_produk', $id)->first();
        if (!empty($produk)) {
            $produk->delete();

            return redirect()->route('produk')->with('status', 'success')->with('message', 'Berhasil menghapus data');
        } else {
            return redirect()->route('produk')->with('status', 'success')->with('message', 'Gagal menghapus data');
        }
    }
}
