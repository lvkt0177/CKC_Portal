<?php

namespace Database\Seeders;

use App\Models\HocKy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class HocKySeeder extends Seeder
{
    public function run()
    {
        $startYears = [2022, 2023, 2024, 2025, 2026]; 

        foreach ($startYears as $startYear) {
            $endYear = $startYear + 3;
            $tenNienKhoa = "$startYear - $endYear";

            $idNienKhoa = DB::table('nien_khoa')->insertGetId([
                'ten_nien_khoa' => $tenNienKhoa,
                'nam_bat_dau' => $startYear,
                'nam_ket_thuc' => $endYear,
                'trang_thai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

     
            $hocKySo = 1;
            for ($i = 0; $i < 3; $i++) {
                $namHienTai = $startYear + $i;

       
                DB::table('hoc_ky')->insert([
                    'id_nien_khoa' => $idNienKhoa,
                    'ten_hoc_ky' => "Học kỳ $hocKySo",
                    'ngay_bat_dau' => Carbon::create($namHienTai, 8, 1),
                    'ngay_ket_thuc' => Carbon::create($namHienTai, 12, 31),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $hocKySo++;

   
                DB::table('hoc_ky')->insert([
                    'id_nien_khoa' => $idNienKhoa,
                    'ten_hoc_ky' => "Học kỳ $hocKySo",
                    'ngay_bat_dau' => Carbon::create($namHienTai + 1, 1, 1),
                    'ngay_ket_thuc' => Carbon::create($namHienTai + 1, 5, 31),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $hocKySo++;
            }
        }
    }
}