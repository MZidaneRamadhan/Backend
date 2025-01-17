<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Pest\Laravel\call;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CompanySeeder::class);
        $this->call(DiscountSeeder::class);
        $this->call(FeeSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ServerSeeder::class);
        $this->call(ClusterSeeder::class);
        $this->call(PelangganSeeder::class);

    }
}
