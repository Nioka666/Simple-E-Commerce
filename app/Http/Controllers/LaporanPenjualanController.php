<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanPenjualanController extends Controller
{
    protected $judul = 'Laporan Penjualan';
    protected $menu = 'Laporan';
    protected $sub_menu = 'laporan_penjualan';
    protected $direktori = 'admin.laporan.laporan_penjualan';

    public function index(Request $request){
        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        if (isset($request->tanggal_awal) && isset($request->tanggal_akhir) && !empty($request->tanggal_awal) && !empty($request->tanggal_akhir)) {
            $data['laporan_penjualan'] = Transaksi::with([
                'users',
                'provinsi',
                'kabupaten',
                'transaksi_detail' => function ($td){
                    $td->with(['produk']);
                }
            ])
            ->whereBetween('tanggal_transaksi', [$request->tanggal_awal, $request->tanggal_akhir])
            ->get();
        } else {
            $data['laporan_penjualan'] = Transaksi::with([
                'users',
                'provinsi',
                'kabupaten',
                'transaksi_detail' => function ($td){
                    $td->with(['produk']);
                }
            ])->orderBy('created_at', 'DESC')->get();
        }

        return view($this->direktori . '.main', $data);
    }

    public function print (Request $request){
        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        if (isset($request->tanggal_awal) && isset($request->tanggal_akhir) && !empty($request->tanggal_awal) && !empty($request->tanggal_akhir)) {
            $data['laporan_penjualan'] = Transaksi::with([
                'users',
                'provinsi',
                'kabupaten',
                'transaksi_detail' => function ($td) {
                    $td->with(['produk']);
                }
            ])
            ->whereBetween('tanggal_transaksi', [$request->tanggal_awal, $request->tanggal_akhir])
            ->get();
        } else {
            $data['laporan_penjualan'] = Transaksi::with([
                'users',
                'provinsi',
                'kabupaten',
                'transaksi_detail' => function ($td) {
                    $td->with(['produk']);
                }
            ])->orderBy('created_at', 'DESC')->get();
        }

        return view($this->direktori . '.print', $data);
    }
}
