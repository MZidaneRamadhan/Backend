<?php

namespace Database\Seeders;

use Faker\Provider\ar_EG\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'nm_company' => 'Tech Innovators',
                'email' => 'info@techinnovators.com',
                'logo_company' => 'logos/tech_innovators.png',
                'alamat' => '123 Tech Street, Silicon Valley, CA',
                'telp' => '123-456-7890',
                'website' => 'https://www.techinnovators.com',
            ],
        ]);
    }
}
