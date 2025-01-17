<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paketData = [
            [
                'company_id' => 1,
                "nm_diskon" => "Odp",
                "tipe" => "flat",
                "jumlah" => "25000",
                "persen" => null,
                "deskripsi" => "deskripsi",
            ],
            [
                'company_id' => 1,
                "nm_diskon" => "Odp1",
                "tipe" => "flat",
                "jumlah" => "30000",
                "persen" => null,
                "deskripsi" => "deskripsi",
            ],
        ];

        foreach ($paketData as $data) {
            Discount::create($data);
        }
    }
}
