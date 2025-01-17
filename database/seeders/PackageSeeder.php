<?php

namespace Database\Seeders;

use App\Models\PaketInternet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paketData = [
            [
                'company_id' => 1,
                'nm_paket' => 'Paket Hemat 10 Mbps',
                'bandwidth' => '10',
                'harga' => 100000,
            ],
            [
                'company_id' => 1,
                'nm_paket' => 'Paket Keluarga 20 Mbps',
                'bandwidth' => '20',
                'harga' => 200000,
            ],
            [
                'company_id' => 1,
                'nm_paket' => 'Paket Premium 50 Mbps',
                'bandwidth' => '50',
                'harga' => 500000,
            ],
        ];

        foreach ($paketData as $data) {
            PaketInternet::create($data);
        }
    }
}
