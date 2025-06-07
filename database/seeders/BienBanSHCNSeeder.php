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
                'id_gvcn' => 1,
                'id_sv' => 1,
                'id_tuan' => 1,
                'tieu_de' => 'Biên bản sinh hoạt chủ nhiệm lớp Tuần 1',
                'noi_dung' => 'Nội dung sinh hoạt chủ nhiệm lớp Tuần 1',
                'thoi_gian_bat_dau' => '2025-06-06 12:00:00',
                'thoi_gian_ket_thuc' => '2025-06-06 12:30:00',
                'so_luong_sinh_vien' => 30,
                'vang_mat' => 5,
                'trang_thai' => 1,
                'created_at' => now(),
            ],
            [
                'id_lop' => 1,
                'id_gvcn' => 1,
                'id_sv' => 1,
                'id_tuan' => 1,
                'tieu_de' => 'Biên bản sinh hoạt chủ nhiệm lớp Tuần 2',
                'noi_dung' => 'Nội dung sinh hoạt chủ nhiệm lớp Tuần 2',
                'thoi_gian_bat_dau' => '2025-06-06 12:00:00',
                'thoi_gian_ket_thuc' => '2025-06-06 12:30:00',
                'so_luong_sinh_vien' => 30,
                'vang_mat' => 5,
                'trang_thai' => 1,
                'created_at' => now(),
            ],
            [
                'id_lop' => 1,
                'id_gvcn' => 1,
                'id_sv' => 1,
                'id_tuan' => 1,
                'tieu_de' => 'Biên bản sinh hoạt chủ nhiệm lớp Tuần 3',
                'noi_dung' => 'Nội dung sinh hoạt chủ nhiệm lớp Tuần 3',
                'thoi_gian_bat_dau' => '2025-06-06 12:00:00',
                'thoi_gian_ket_thuc' => '2025-06-06 12:30:00',
                'so_luong_sinh_vien' => 30,
                'vang_mat' => 5,
                'trang_thai' => 1,
                'created_at' => now(),
            ],
            
            
        ]);
    }
}
