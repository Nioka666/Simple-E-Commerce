<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    protected $judul = 'Dashboard';
    protected $menu = 'dashboard';
    protected $sub_menu = '';
    protected $direktori = 'user.dashboard';

    public function main (Request $request){
        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['kategori_produk'] = KategoriProduk::with('produk')->get();
        $data['produk'] = Produk::with('kategori_produk')->get();

        return view($this->direktori . '.main', $data);
    }

    public function addToCart(Request $request){
        // product checking
        $id = $request->id;

        if (Auth::check()) {
            $check_keranjang = Keranjang::where('produk_id', $id)
            ->where('user_id', Auth::id())->first();

            if ($check_keranjang) {
                $check_keranjang->qty = $check_keranjang->qty + 1;
                # code...
            } else {
                $check_keranjang = new Keranjang();
                $check_keranjang->produk_id = $id;
                $check_keranjang->qty = 1;
                $check_keranjang->user_id = Auth::id();
            }

            $check_keranjang->save();

            if ($check_keranjang) {
                return redirect()->route('userDashboard')
                ->with('status', 'success')
                ->with('message', 'Berhasil menambah ke Keranjang');
            } else {
                return redirect()->route('userDashboard')
                ->with('status', 'error')
                ->with('message', 'Gagal menambah ke Keranjang');
            }
        } else {
            return redirect()->route('userDashboard')
                ->with('status', 'error')
                ->with('message', 'Anda belum Login!');
        }
    }

    public function removeToCart(Request $request){
        $id = $request->id;

        if (Auth::check()) {
            $check_keranjang = Keranjang::where('produk_id', $id)
            ->where('user_id', Auth::id())->first();
            $check_keranjang->delete();

            if ($check_keranjang) {
                return redirect()->route('userDashboard')
                ->with('status', 'success')
                ->with('message', 'Berhasil menghapus produk');
            } else {
                return redirect()->route('userDashboard')
                ->with('status', 'error')
                ->with('message', 'Gagal menghapus produk');
            }
        } else {
            return redirect()->route('userDashboard')
                ->with('status', 'error')
                ->with('message', 'Anda belum Login!');
        }
    }
}
