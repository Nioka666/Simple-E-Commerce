<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\KategoriProduk;
use App\Http\Requests\StoreKategoriProdukRequest;
use App\Http\Requests\UpdateKategoriProdukRequest;
use App\Models\Produk;
use App\Models\TransaksiDetail;
use App\Models\User;
use App\Models\Users;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $judul = 'Transaksi';
    protected $menu = 'transaksi';
    protected $sub_menu = '';
    protected $direktori = 'admin.transaksi';

    public function index()
    {
        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['transaksi'] = Transaksi::with(['users'])->orderBy('created_at', 'DESC')->get();

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

            'users' => Users::where('level_user', 'Pengguna')->get(),
            'produk' => Produk::with(['kategori_produk'])->get()
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
        $user_id = $request->user_id;
        $produk_id = $request->produk_id;
        $tanggal_transaksi = $request->tanggal_transaksi;
        $ekspedisi = $request->ekspedisi;
        $catatan_pembeli = $request->catatan_pembeli;

        if (empty($user_id)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Pembeli harus diisi'); // !!!
        }

        if (empty($produk_id)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Produk harus diisi');
        }
        if (empty($tanggal_transaksi)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Tanggal Transaksi harus diisi');
        }
        if (empty($ekspedisi)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Ekspedisi harus diisi');
        }
        // if (empty($catatan_pembeli)) {
        //     return back()->withInput()->with('status', 'error')->with('message', 'Kategori Produk sudah terdaftar pada sistem');
        // }

        // Simpan
        $users = User::where('id', $user_id)->first();
        $transaksi = Transaksi::orderBy('id_transaksi', 'DESC')->first();
        $kode_transaksi = 'TR-000' . ((int)substr($transaksi->kode_transaksi, 6) + 1);

        // instansiasi object / eloquent baru
        $transaksi = new Transaksi();
        $transaksi->kode_transaksi = $kode_transaksi;
        $transaksi->kode_invoice = '-';

        $transaksi->user_id = $user_id;
        $transaksi->tanggal_transaksi = date('Y-m-d', strtotime($tanggal_transaksi));
        $transaksi->status_transaksi = 'Selesai';

        $transaksi->provinsi_id = $users->provinsi_id;
        $transaksi->kabupaten_id = $users->kabupaten_id;
        $transaksi->kode_pos = $users->kode_pos;
        $transaksi->alamat_lengkap = $users->alamat_lengkap;

        $transaksi->ekspedisi = $ekspedisi;
        $transaksi->catatan_pembeli = $catatan_pembeli;
        $transaksi->save();

        if ($transaksi) {
            $transaksi = Transaksi::where('id_transaksi', $transaksi->id_transaksi)->first();
            $transaksi->kode_invoice = date('dmY') . '' . $transaksi->id_transaksi;
            $transaksi->save();

            $transaksi_detail = new TransaksiDetail();
            $transaksi_detail->transaksi_id = $transaksi->id_transaksi;
            $transaksi_detail->produk_id = $produk_id;
            $transaksi_detail->qty = 1;
            $transaksi_detail->save(); // edited

            if ($transaksi_detail) {
                $produk = Produk::where('id_produk', $produk_id)->first();
                $produk->stok_produk = ($produk->stok_produk - 1);
                $produk->save();
            }
        }

        if ($transaksi) {
            return redirect()->route('transaksi')->with('status', 'success')->with('message', 'Berhasil menyimpan data');
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
            'transaksi' => Transaksi::with([
                'users',
                'provinsi',
                'kabupaten',
                'transaksi_detail' => function ($td) {
                    $td->with(['produk']);
                }
            ])->where('id_transaksi', $id)->first(),
            // variable jumlah transaksi
            'total_jumlah_transaksi' => Transaksi::selectRaw('SUM(p.harga_produk*td.qty) as jumlah')
            ->join('transaksi_detail as td', 'td.transaksi_id', 'transaksi.id_transaksi')
            ->join('produk as p', 'p.id_produk', 'td.produk_id')->where('id_transaksi', $id)
            ->first()->jumlah
        ];

        // return $data['total_jumlah_transaksi'];

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
            'kategori_produk' => Transaksi::where('id_kategori_produk', $id)->first()
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
        $nama_kategori_produk = $request->nama_kategori_produk;
        // $slug_kategori_produk = $request->username;

        if (empty($nama_kategori_produk)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Nama Kategori Produk harus diisi'); // !!!
        }

        $cek_kp = Transaksi::where('nama_kategori_produk', $nama_kategori_produk)->where('id_kategori_produk', '!=', $id)->first();

        if (!empty($cek_kp)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kategori Produk sudah terdaftar pada sistem');
        }

        // Simpan

        $KategoriProduk = Transaksi::where('id_kategori_produk', $id)->first();
        $KategoriProduk->nama_kategori_produk = $nama_kategori_produk;
        $KategoriProduk->slug_kategori_produk = Str::slug($nama_kategori_produk);
        $KategoriProduk->save();

        if ($KategoriProduk) {
            return redirect()->route('kategoriProduk')->with('status', 'success')->with('message', 'Berhasil mengubah data');
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
    public function tolak($id)
    {
        $transaksi = Transaksi::where('id_transaksi', $id)->first();
        if (!empty($transaksi)) {
            if ($transaksi->status_transaksi == 'Pending' || $transaksi->status_transaksi == 'Selesai') {
                $transaksi->status_transaksi = 'Tolak';
                $transaksi->save();

                if ($transaksi) {
                    $transaksi_detail = TransaksiDetail::where('transaksi_id', $transaksi->id_transaksi)->get();

                    foreach ($transaksi_detail as $key => $td) {
                        $produk = Produk::where('id_produk', $td->produk_id)->first();
                        $produk->stok_produk = ($produk->stok_produk - $td->qty);
                        $produk->save();
                        # code...
                    }
                    return redirect()->route('transaksi')->with('status', 'success')->with('message', 'Berhasil menolak transaksi');
                    # code...
                } else {
                    return redirect()->route('transaksi')->with('status', 'error')->with('message', 'Gagal menolak Transksi');
                }
            } else {
                return redirect()->route('transaksi')->with('status', 'error')->with('message', 'Status Transaksi tidak sesuai');
            }
        } else {
            return redirect()->route('transaksi')->with('status', 'error')->with('message', 'Gagagl menolak Transaksi');
        }
    }

    public function proses($id){
        $transaksi = Transaksi::where('id_transaksi', $id)->first();
        if (!empty($transaksi)) {
            if ($transaksi->status_transaksi == 'Pending') {
                $transaksi->status_transaksi = 'Proses Admin';
                $transaksi->kode_invoice = date('dmY') . '' . $transaksi->id_transaksi;
                $transaksi->save();

                if ($transaksi) {
                    return redirect()->route('transaksi')->with('status', 'success')->with('message', 'Berhasil memproses Transaksi');
                    # code...
                } else {
                    return redirect()->route('transaksi')->with('status', 'error')->with('message', 'Gagal memproses Transaksi');
                }
            } else {
                return redirect()->route('transaksi')->with('status', 'error')->with('message', 'Status Transaksi tidak sesuai');
            }
        } else {
            return redirect()->route('transaksi')->with('status', 'error')->with('message', 'Gagal memproses Transaksi');
        }
    }

    public function kirim($id){
        $transaksi = Transaksi::where('id_transaksi', $id)->first();
        if (!empty($transaksi)) {
            if ($transaksi->status_transaksi == 'Proses Admin') {
                $transaksi->status_transaksi = 'Pengiriman';
                $transaksi->save();

                if ($transaksi) {
                    return redirect()->route('transaksi')->with('status', 'success')->with('message', 'Berhasil mengirim Transaksi');
                } else {
                    return redirect()->route('transaksi')->with('status', 'error')->with('message', 'Gagal mengirim Transaksi');
                }
            } else {
                return redirect()->route('transaksi')->with('status', 'error')->with('message', 'Status Transaksi tidak sesuai');
            }
        } else {
            return redirect()->route('transaksi')->with('status', 'error')->with('message', 'Gagal mengirim Transaksi');
        }
    }

    public function selesai ($id){
        $transaksi = Transaksi::where('id_transaksi', $id)->first();
        if (!empty($transaksi)) {
            if ($transaksi->status_transaksi == 'Pengiriman') {
                $transaksi->status_transaksi = 'Selesai';
                $transaksi->save();

                if ($transaksi) {
                    return redirect()->route('transaksi')->with('status'. 'success')->with('message', 'Berhasil Menyelesaikan Transaksi');
                } else {
                    return redirect()->route('transaksi')->with('status'. 'error')->with('message', 'Gagal Menyelesaikan Transaksi');
                }
            } else {
                return redirect()->route('transaksi')->with('status'. 'error')->with('message', 'Status Transaksi tidak sesuai');
            }
        } else {
            return redirect()->route('transaksi')->with('status'. 'error')->with('message', 'Gagal Menyelesaikan Transaksi');
        }
    }
}
