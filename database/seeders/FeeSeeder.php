<?php

namespace Database\Seeders;

use App\Models\BiayaTambahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paketData = [
            [
                'company_id' => 1,
                "nm_biaya"=> "STB Android",
                "jumlah"=> "25000",
                "deskripsi"=> "ini deskripsi",
            ],
            [
                'company_id' => 1,
                "nm_biaya"=> "STB Android Delta",
                "jumlah"=> "30000",
                "deskripsi"=> "ini deskripsi",
            ],
        ];

        foreach ($paketData as $data) {
            BiayaTambahan::create($data);
        }
    }
}
