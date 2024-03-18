<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Provinsi;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    protected $judul = 'Checkout';
    protected $menu = 'checkout';
    protected $sub_menu = '';
    protected $direktori = 'user.checkout';

    public function main(Request $request)
    {
        $id = $request->id;

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['keranjang'] = Keranjang::find($id);
        $data['user'] = Users::find($data['keranjang']->user_id);
        $data['kabupaten'] = Kabupaten::find($data['user']->kabupaten_id);
        $data['provinsi'] = Provinsi::find($data['user']->provinsi_id);
        $data['produk'] = Produk::with('kategori_produk')
            ->find($data['keranjang']->produk_id);

        return view($this->direktori . '.main', $data);
    }

    public function proses(Request $request)
    {
        $id_user = $request->id_user;
        $id_keranjang = $request->id_keranjang;
        $tanggal_transaksi = date('Y-m-d');
        $ekspedisi = $request->ekspedisi;
        $catatan_pembeli = $request->catatan_pembeli;

        if (empty($id_user)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Pembeli harus diisi');
        }
        if (empty($id_keranjang)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Keranjang harus diisi');
        }
        if (empty($tanggal_transaksi)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Tanggal Transaksi harus diisi');
        }
        if (empty($ekspedisi)) {
            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Ekspedisi harus diisi');
        }
        if (empty($catatan_pembeli)) {
            $catatan_pembeli = '-';
        }

        $users = Users::find($id_user);
        $transaksi = Transaksi::find($id_user);
        $kode_transaksi = 'TR-000' . ((int)substr($transaksi->kode_transaksi, 6) + 1);
        $keranjang = Keranjang::find($id_keranjang);

        // save
        $transaksi = new Transaksi();
        $transaksi->kode_transaksi = $kode_transaksi;
        $transaksi->kode_transaksi = $kode_transaksi;
        $transaksi->kode_invoice = '-';

        $transaksi->user_id = $id_user;
        $transaksi->tanggal_transaksi = date('Y-m-d', strtotime($tanggal_transaksi));
        $transaksi->status_transaksi = 'Pending';

        $transaksi->provinsi_id = $users->provinsi_id;
        $transaksi->kabupaten_id = $users->kabupaten_id;
        $transaksi->kode_pos = $users->kode_pos;
        $transaksi->alamat_lengkap = $users->alamat_lengkap;

        $transaksi->ekspedisi = $ekspedisi;
        $transaksi->catatan_pembeli = $catatan_pembeli;
        $transaksi->save();

        if ($transaksi) {
            $transaksi = Transaksi::where('id_transaksi', $transaksi->id_transaksi)->first();
            $transaksi->kode_invoice = date('dmY',) . '' . $transaksi->id_transaksi;
            $transaksi->save();

            $transaksi_detail = new TransaksiDetail();
            $transaksi_detail->transaksi_id = $transaksi->id_transaksi;
            $transaksi_detail->produk_id = $keranjang->produk_id;
            $transaksi_detail->qty = $keranjang->qty;
            $transaksi_detail->save();

            if ($transaksi_detail) {
                $produk = Produk::where('id_produk', $keranjang->produk_id)->first();
                $produk->stok_produk = ($produk->stok_produk - 1);
                $produk->save();
                # code...
            }
            # code...
        }
        if ($transaksi) {
            $keranjang->delete();
            return redirect()->route('userDashboard')->with('status', 'success')->with('message', 'Berhasil menyimpan data');
        } else {
            return back()->withInput()->with('status', 'error')->with('message', 'Gagal menyimpan data');
        }
    }

    public function history(Request $request)
    {
        if (Auth::check()) {
            $data['judul'] = $this->judul;
            $data['menu'] = $this->menu;
            $data['sub_menu'] = $this->sub_menu;

            $data['transaksi'] = Transaksi::with('users')
                ->with('provinsi')->with('provinsi')
                ->with('kabupaten')->with('transaksi_detail')
                ->with('transaksi_detail.produk')->where('user_id', Auth::id())
                ->get();

            return view($this->direktori . '.history', $data);
            # code...
        } else {
            return redirect()->route('userDashboard')
                ->with('status', 'error')
                ->with('message', 'Anda belum login!');
        }
    }

    public function complete(Request $request)
    {
        $id = $request->id;
        $get_checkout = Transaksi::find($id);

        if ($get_checkout) {
            $get_checkout->status_transaksi = 'Selesai';
            $get_checkout->save();

            if ($get_checkout) {
                return redirect()->route('userCheckoutHistory')
                    ->with('status', 'success')->with('message', 'Berhasil Mengubah Status Menjadi Selesai');
            } else {
                return redirect()->route('userCheckoutHistory')
                    ->with('status', 'error')->with('message', 'Gagal Mengubah Status Menjadi Selesai!');
            }
        } else {
            return redirect()->route('userCheckoutHistory')
                ->with('status', 'error')->with('message', 'Gagal Mengubah Status Menjadi Selesai!');
        }
    }
}
