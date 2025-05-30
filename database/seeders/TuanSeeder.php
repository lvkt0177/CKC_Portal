<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tuan;

class TuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Tuan::insert([
            ['id_nam' => 1, 'tuan' => 1, 'ngay_bat_dau' => '2023-08-04', 'ngay_ket_thuc' => '2023-12-10'],
            ['id_nam' => 2, 'tuan' => 2, 'ngay_bat_dau' => '2024-01-11', 'ngay_ket_thuc' => '2024-04-17'],
            ['id_nam' => 3, 'tuan' => 3, 'ngay_bat_dau' => '2025-08-18', 'ngay_ket_thuc' => '2025-12-24'],
        ]);
    }
}
