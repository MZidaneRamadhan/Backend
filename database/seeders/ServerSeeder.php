<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servers = [
            [
                'company_id' => 1,
                'lokasi_server' => 'Jakarta',
                'alamat' => 'Jl. Sudirman No. 1',
                'ip_router' => 30,
                'port_api' => 30,
                'jatuh_tempo' => 30,
                'jatuh_tempo' => 30,
                'pajak' => 'Aktif',
                'status' => 'Connected',
                'username' => 'Connected',
                'password' => 'Connected',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 1,
                'lokasi_server' => 'Bandung',
                'alamat' => 'Jl. Asia Afrika No. 10',
                'ip_router' => 60,
                'port_api' => 60,
                'jatuh_tempo' => 60,
                'jatuh_tempo' => 60,
                'pajak' => 'Tidak aktif',
                'status' => 'Connected',
                'username' => 'Connected',
                'password' => 'Connected',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 1,
                'lokasi_server' => 'Surabaya',
                'alamat' => 'Jl. Tunjungan No. 15',
                'ip_router' => 45,
                'port_api' => 45,
                'jatuh_tempo' => 45,
                'jatuh_tempo' => 45,
                'pajak' => 'Aktif',
                'status' => 'Diconnected',
                'username' => 'Diconnected',
                'password' => 'Diconnected',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('server')->insert($servers);
    }
}
