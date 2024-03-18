<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;

    protected $table = 'transaksi_detail';
    protected $primaryKey = 'id_transaksi_detail';

    function transaksi(){
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    function produk(){
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
