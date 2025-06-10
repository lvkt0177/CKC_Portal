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
        'id_nam' => 1,
        'tuan' => 1,
        'ngay_bat_dau' => Carbon::create(2023, 6, 2),
        'ngay_ket_thuc' => Carbon::create(2023, 6, 8),
    ],
    [
        'id_nam' => 2,
        'tuan' => 1,
        'ngay_bat_dau' => Carbon::create(2024, 6, 2),
        'ngay_ket_thuc' => Carbon::create(2024, 6, 8),
    ],
    ]);
    $startDate = Carbon::create(2024, 12, 30); // 06/01/2025
        $id_nam = 3; // ID năm cần gán
        $totalWeeks = 52;

        for ($i = 1; $i <= $totalWeeks; $i++) {
            $ngay_bat_dau = $startDate->copy();
            $ngay_ket_thuc = $startDate->copy()->addDays(6);

            Tuan::create([
                'id_nam' => $id_nam,
                'tuan' => $i,
                'ngay_bat_dau' => $ngay_bat_dau,
                'ngay_ket_thuc' => $ngay_ket_thuc,
            ]);

            $startDate->addWeek(); // sang tuần tiếp theo
        }
    }
}