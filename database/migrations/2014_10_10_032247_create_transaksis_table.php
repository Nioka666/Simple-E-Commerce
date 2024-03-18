<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->string('kode_transaksi')->comment('dibuat saat pertama kali membuat transaksi');
            $table->string('kode_invoice')->comment('dibuat saat merubah status transaksi menjadi proses admin');
            $table->date('tanggal_transaksi');
            $table->enum('status_transaksi', ['Pending', 'Tolak', 'Proses Admin', 'Pengiriman', 'Selesai']);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('provinsi_id');
            $table->foreign('provinsi_id')->references('id_provinsi')->on('provinsi');
            $table->unsignedBigInteger('kabupaten_id');
            $table->foreign('kabupaten_id')->references('id_kabupaten')->on('kabupaten');
            $table->string('kode_pos');
            $table->text('alamat_lengkap');
            $table->string('ekspedisi')->comment('hanya JNE');
            $table->text('catatan_pembeli');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
