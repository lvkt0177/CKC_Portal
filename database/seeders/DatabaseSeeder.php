<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            HoSoSeeder::class,
            KhoaSeeder::class,
            NganhHocSeeder::class,
            BoMonSeeder::class,
            ChuyenNganhSeeder::class,
            UserSeeder::class,
            NienKhoaSeeder::class,
            LopSeeder::class,
            SinhVienSeeder::class,
            RolePermissionSeeder::class,
        ]);

    }
}