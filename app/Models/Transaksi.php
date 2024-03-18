<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';

    public function users(){
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function transaksi_detail () {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }

    public function provinsi () {
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }

    public function kabupaten () {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

}
