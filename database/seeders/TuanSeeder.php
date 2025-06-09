<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tuan;
use Carbon\Carbon;


class TuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Tuan::insert([
    [
        'id_nam' => 3,
        'tuan' => 1,
        'ngay_bat_dau' => Carbon::create(2025, 6, 2),
        'ngay_ket_thuc' => Carbon::create(2025, 6, 8),
    ],
    [
        'id_nam' => 3,
        'tuan' => 2,
        'ngay_bat_dau' => Carbon::create(2025, 6, 9),
        'ngay_ket_thuc' => Carbon::create(2025, 6, 15),
    ],
    [
        'id_nam' => 3,
        'tuan' => 3,
        'ngay_bat_dau' => Carbon::create(2025, 6, 16),
        'ngay_ket_thuc' => Carbon::create(2025, 6, 22),
    ],
    [
        'id_nam' => 3,
        'tuan' => 4,
        'ngay_bat_dau' => Carbon::create(2025, 6, 23),
        'ngay_ket_thuc' => Carbon::create(2025, 6, 29),
    ],
    ]);
    }
}