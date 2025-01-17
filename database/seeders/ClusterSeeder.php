<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClusterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cluster')->insert([
            [
                'company_id' => 1,
                'nm_cluster' => 'Cluster A',
                'jumlah_port' => '48',
                'jenis' => 'Fiber Optic',
                'server_id' => 1,
                'koordinat' => '-6.200000, 106.816666',
                'alamat' => 'Jalan Sudirman No. 1, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 1,
                'nm_cluster' => 'Cluster B',
                'jumlah_port' => '24',
                'jenis' => 'Copper',
                'server_id' => 2,
                'koordinat' => '-6.900000, 107.600000',
                'alamat' => 'Jalan Dago No. 10, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 1,
                'nm_cluster' => 'Cluster C',
                'jumlah_port' => '16',
                'jenis' => 'Fiber Optic',
                'server_id' => 3,
                'koordinat' => '-7.250000, 112.750000',
                'alamat' => 'Jalan Tunjungan No. 5, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 1,
                'nm_cluster' => 'Cluster D',
                'jumlah_port' => '32',
                'jenis' => 'Wireless',
                'server_id' => 4,
                'koordinat' => '-8.650000, 115.216666',
                'alamat' => 'Jalan Sunset Road No. 8, Bali',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
