<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path('database/produk.sql');
        $sqlfile = DB::unprepared(file_get_contents($path));
        $db_bin = "D:\applications\laragon\bin\mysql\mysql-8.0.30-winx64\bin";

        $db = [
            'username' => 'root',
            'password' => '',
            'host' => 'localhost',
            'database' => 'up_skaneda'
        ];

        exec("$db_bin}\mysql --user={$db['username']} --password={$db['password']} --host={$db['host']} --database={$db['database']} < $sqlfile");

        Log::info('import SQL Success from sql file' . $path . '');
    }
}
