<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $prefix = "SVN";
            $timestamp = now()->format('YmdHis');
            $randomNumber = rand(1000, 9999);
            $serviceNumber = $randomNumber;

            // Create Pelanggan record
            Pelanggan::create([
                'company_id' => 1,
                'nomor_layanan'     => $serviceNumber,
                'name'              => 'Customer ' . $i,
                'telp'              => '0812345678' . $i,
                'email'             => 'customer' . $i . '@example.com',
                'status_tagihan'    => 'Lunas',
                'server_id'         => rand(1, 3), // ID server secara acak
                'cluster_id'        => rand(1, 3), // ID cluster secara acak
                'paket_internet_id' => rand(1, 3), // ID paket internet secara acak
                'login'             => 'user' . $i,
                'sales'             => 'Sales ' . $i,
                'no_ktp'            => '123456789012345' . $i,
                'tgl_pemasangan'    => now()->subDays(rand(1, 30))->format('Y-m-d'),
                'tgl_jatuh_tempo'   => now()->addDays(rand(1, 30))->format('Y-m-d'),
                'biaya_pemasangan'  => rand(100000, 500000),
                'foto'              => 'path/to/photo' . $i . '.jpg',
                'koordinat'         => '(-6.' . rand(100000, 999999) . ', 106.' . rand(100000, 999999) . ')',
                'metode_langganan'  => 'Bulanan',
                'biaya_tambahan_id' =>  rand(1, 2),
                'diskon_id'         =>  rand(1, 2),
                'alamat'            => 'Jl. Contoh Alamat No. ' . $i,
                'provinsi'          => 'Provinsi ' . $i,
                'kota'              => 'Kota ' . $i,
                'kecamatan'         => 'Kecamatan ' . $i,
                'desa'              => 'Desa ' . $i,
            ]);
        }
    }
}
