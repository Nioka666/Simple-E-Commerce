<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    protected $judul = 'Produk';
    protected $menu = 'produk';
    protected $sub_menu = '';
    protected $direktori = 'user.produk';

    public function main(Request $request){
        $slug = $request->slug;

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['produk'] = Produk::with('kategori_produk')
        ->where('slug_produk', $slug)->first();

        return view($this->direktori . '.main', $data);
    }
    //
}
