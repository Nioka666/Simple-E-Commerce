<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_telp', 15)->nullable();
            $table->unsignedBigInteger('provinsi_id')->nullable();
            $table->unsignedBigInteger('kabupaten_id')->nullable(); // Tambahkan definisi kolom kabupaten_id
            $table->foreign('provinsi_id')->references('id_provinsi')->on('provinsi');
            $table->foreign('kabupaten_id')->references('id_kabupaten')->on('kabupaten');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('kode_pos')->nullable(); // Tambahkan tanda kurung ()
            $table->text('alamat_lengkap')->nullable(); // Tambahkan tanda kurung ()
            $table->enum('level_user', ['Admin', 'Pengguna'])->nullable(); // Tambahkan tanda kurung ()
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
        Schema::dropIfExists('users');
    }
}
