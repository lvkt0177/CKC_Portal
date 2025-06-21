<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nam;
use App\Models\Tuan;
use Carbon\Carbon;



class TuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($year = 2022; $year <= 2026; $year++) {
            // 🔹 Tạo năm nếu chưa có
            $nam = Nam::firstOrCreate(
                ['nam_bat_dau' => $year]
            );

            // 🔹 Bắt đầu từ thứ 2 gần nhất trước hoặc bằng ngày 5/8
            $startDate = Carbon::create($year, 8, 5)->startOfWeek(Carbon::MONDAY);

            for ($week = 1; $week <= 52; $week++) {
                $ngay_bat_dau = $startDate->copy();
                $ngay_ket_thuc = $startDate->copy()->addDays(6);

                // 🔹 Tạo hoặc cập nhật tuần
                Tuan::updateOrCreate(
                    [
                        'id_nam' => $nam->id,
                        'tuan' => $week
                    ],
                    [
                        'ngay_bat_dau' => $ngay_bat_dau,
                        'ngay_ket_thuc' => $ngay_ket_thuc
                    ]
                );

                $startDate->addWeek();
            }
        }

    }
}