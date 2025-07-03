<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SinhVien;
use App\Models\HoSo;
use Illuminate\Support\Facades\Hash;
use App\Models\Lop;
use App\Models\LopChuyenNganh;

class SinhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sinhviens = [
            [
                "ma_sv" => "0306221",
                "lop_type" => Lop::class,
                "id_lop" => 1,
                "id_ho_so" => 4,
                "chuc_vu" => 0,
                "password" => Hash::make('Thinh3988@'),
                "trang_thai" => 0,
            ],
            [
                "ma_sv" => "0306229",
                "lop_type" => Lop::class,
                "id_lop" => 1,
                "id_ho_so" => 14,
                "chuc_vu" => 0,
                "password" => Hash::make('1a@'),
                "trang_thai" => 0,
            ],
            [
                "ma_sv" => "0306222",
                "lop_type" => Lop::class,
                "id_lop" => 2,
                "id_ho_so" => 5,
                "chuc_vu" => 0,
                "password" => Hash::make('Thinh3988@'),
                "trang_thai" => 0,
            ],
            [
                "ma_sv" => "0306231",
                "lop_type" => LopChuyenNganh::class,
                "id_lop" => 1,
                "id_ho_so" => 6,
                "chuc_vu" => 0,
                "password" => Hash::make('Thinh3988@'),
                "trang_thai" => 0,
            ],
            [
                "ma_sv" => "0306232",
                "lop_type" => LopChuyenNganh::class,
                "id_lop" => 2,
                "id_ho_so" => 7,
                "chuc_vu" => 0,
                "password" => Hash::make('Thinh3988@'),
                "trang_thai" => 0,
            ],
            [
                "ma_sv" => "0306233",
                "lop_type" => LopChuyenNganh::class,
                "id_lop" => 3,
                "id_ho_so" => 8,
                "chuc_vu" => 0,
                "password" => Hash::make('Thinh3988@'),
                "trang_thai" => 0,
            ],
        ];

        foreach ($sinhviens as $data) {
            SinhVien::create($data);
        }
    }
}