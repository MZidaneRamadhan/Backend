<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'company_id' => 1,
            'name' => 'Test User',
            'email' => 'test2@example.com',
            'password' => Hash::make('password123'),
            'telp' => '08951872314',
            'alamat' => 'Jl. Soeta',
            'tgl_bergabung' => now(),
            'role' => 'admin',
        ]);
    }
}
