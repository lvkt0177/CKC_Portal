<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BienBanSHCN;

class BienBanSHCNSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        BienBanSHCN::insert([
            [
                'id_lop' => 1,
                'tieu_de' => 'Biên bản sinh hoạt chủ nhiệm lớp Tuần 1',
                'noi_dung' => 'Nội dung sinh hoạt chủ nhiệm lớp Tuần 1',
                'ngay_bat_dau' => '2023-09-01',
                'tuan' => 1,
                'nam_hoc' => 2023,
                'thoi_gian_bat_dau' => '08:00:00',
                'thoi_gian_ket_thuc' => '09:00:00',
                'so_luong_sinh_vien' => 30,
                'vang_mat' => 5,
                'trang_thai' => 1,
                'created_at' => now(),
            ],
            [
                'id_lop' => 2,
                'tieu_de' => 'Biên bản sinh hoạt chủ nhiệm lớp Tuần 2',
                'noi_dung' => 'Nội dung sinh hoạt chủ nhiệm lớp Tuần 2',
                'ngay_bat_dau' => '2023-09-01',
                'tuan' => 2,
                'nam_hoc' => 2023,
                'thoi_gian_bat_dau' => '08:00:00',
                'thoi_gian_ket_thuc' => '09:00:00',
                'so_luong_sinh_vien' => 30,
                'vang_mat' => 5,
                'trang_thai' => 1,
                'created_at' => now(),
            ],
            [
                'id_lop' => 3,
                'tieu_de' => 'Biên bản sinh hoạt chủ nhiệm lớp Tuần 3',
                'noi_dung' => 'Nội dung sinh hoạt chủ nhiệm lớp Tuần 3',
                'ngay_bat_dau' => '2023-09-01',
                'tuan' => 2,
                'nam_hoc' => 2023,
                'thoi_gian_bat_dau' => '08:00:00',
                'thoi_gian_ket_thuc' => '09:00:00',
                'so_luong_sinh_vien' => 30,
                'vang_mat' => 5,
                'trang_thai' => 1,
                'created_at' => now(),
            ]
        ]);
    }
}
