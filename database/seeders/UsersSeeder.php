<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "id" => 1,
                "nama_lengkap" => "Admin",
                "username" => "admin",
                "email" => "admin@gmail.com",
                "password" => bcrypt('admin'),
                "no_telp" => null,
                "provinsi_id" => null,
                "kabupaten_id" => null,
                "kode_pos" => null,
                "alamat_lengkap" => null,
                "level_user" => "Admin",
            ],
            [
                "id" => 2,
                "nama_lengkap" => "Pengguna",
                "username" => "Pengguna",
                "email" => "pengguna@gmail.com",
                "password" => bcrypt('pengguna'),
                "no_telp" => "087755588990",
                "provinsi_id" => 35,
                "kabupaten_id" => 3576,
                "kode_pos" => 61354,
                "alamat_lengkap" => "Kota Mojokerto",
                "level_user" => "Pengguna",
            ]
        ];
        Schema::disableForeignKeyConstraints();

        User::insert($users);

        Schema::enableForeignKeyConstraints();
    }
}
