<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DanhSachSinhVien;

class DanhSachSinhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DanhSachSinhVien::insert([
            // Lớp TH 22A
            ["id_sinh_vien" => 1, "id_lop" => 1, "chuc_vu" => 1],
            ["id_sinh_vien" => 2, "id_lop" => 1, "chuc_vu" => 0],
            ["id_sinh_vien" => 3, "id_lop" => 1, "chuc_vu" => 0],
            ["id_sinh_vien" => 4, "id_lop" => 1, "chuc_vu" => 0],
            ["id_sinh_vien" => 5, "id_lop" => 1, "chuc_vu" => 0],
            ["id_sinh_vien" => 6, "id_lop" => 1, "chuc_vu" => 0],

            // Lớp TH 22B
            ["id_sinh_vien" => 7, "id_lop" => 2, "chuc_vu" => 1],
            ["id_sinh_vien" => 8, "id_lop" => 2, "chuc_vu" => 0],
            ["id_sinh_vien" => 9, "id_lop" => 2, "chuc_vu" => 0],
            ["id_sinh_vien" => 10, "id_lop" => 2, "chuc_vu" => 0],
            ["id_sinh_vien" => 11, "id_lop" => 2, "chuc_vu" => 0],
            ["id_sinh_vien" => 12, "id_lop" => 2, "chuc_vu" => 0],

            // Lớp TH 23A
            ["id_sinh_vien" => 13, "id_lop" => 3, "chuc_vu" => 1],
            ["id_sinh_vien" => 14, "id_lop" => 3, "chuc_vu" => 0],
            ["id_sinh_vien" => 15, "id_lop" => 3, "chuc_vu" => 0],
            ["id_sinh_vien" => 16, "id_lop" => 3, "chuc_vu" => 0],
            ["id_sinh_vien" => 17, "id_lop" => 3, "chuc_vu" => 0],
            ["id_sinh_vien" => 18, "id_lop" => 3, "chuc_vu" => 0],

            // Lớp TH 23B
            ["id_sinh_vien" => 19, "id_lop" => 4, "chuc_vu" => 1],
            ["id_sinh_vien" => 20, "id_lop" => 4, "chuc_vu" => 0],
            ["id_sinh_vien" => 21, "id_lop" => 4, "chuc_vu" => 0],
            ["id_sinh_vien" => 22, "id_lop" => 4, "chuc_vu" => 0],
            ["id_sinh_vien" => 23, "id_lop" => 4, "chuc_vu" => 0],
            ["id_sinh_vien" => 24, "id_lop" => 4, "chuc_vu" => 0],

            // Lớp TH 24A
            ["id_sinh_vien" => 25, "id_lop" => 5, "chuc_vu" => 1],
            ["id_sinh_vien" => 26, "id_lop" => 5, "chuc_vu" => 0],
            ["id_sinh_vien" => 27, "id_lop" => 5, "chuc_vu" => 0],
            ["id_sinh_vien" => 28, "id_lop" => 5, "chuc_vu" => 0],
            ["id_sinh_vien" => 29, "id_lop" => 5, "chuc_vu" => 0],
            ["id_sinh_vien" => 30, "id_lop" => 5, "chuc_vu" => 0],

            // Lớp TH 24B
            ["id_sinh_vien" => 31, "id_lop" => 6, "chuc_vu" => 1],
            ["id_sinh_vien" => 32, "id_lop" => 6, "chuc_vu" => 0],
            ["id_sinh_vien" => 33, "id_lop" => 6, "chuc_vu" => 0],
            ["id_sinh_vien" => 34, "id_lop" => 6, "chuc_vu" => 0],
            ["id_sinh_vien" => 35, "id_lop" => 6, "chuc_vu" => 0],
            ["id_sinh_vien" => 36, "id_lop" => 6, "chuc_vu" => 0],

            // Lớp Chuyên ngành Khoá 22 - Lập trình Website
            ["id_sinh_vien" => 1, "id_lop" => 7, "chuc_vu" => 1],
            ["id_sinh_vien" => 2, "id_lop" => 7, "chuc_vu" => 0],
            ["id_sinh_vien" => 7, "id_lop" => 7, "chuc_vu" => 0],
            ["id_sinh_vien" => 8, "id_lop" => 7, "chuc_vu" => 0],
       
            // Lớp Chuyên Ngành Khoá 22 - Lập trình Mạng máy tính
            ["id_sinh_vien" => 3, "id_lop" => 8, "chuc_vu" => 1],
            ["id_sinh_vien" => 4, "id_lop" => 8, "chuc_vu" => 0],
            ["id_sinh_vien" => 9, "id_lop" => 8, "chuc_vu" => 0],
            ["id_sinh_vien" => 10, "id_lop" => 8, "chuc_vu" => 0],

            // Lớp Chuyên Ngành Khoá 22 - Lập trình Di động
            ["id_sinh_vien" => 5, "id_lop" => 9, "chuc_vu" => 1],
            ["id_sinh_vien" => 6, "id_lop" => 9, "chuc_vu" => 0],
            ["id_sinh_vien" => 11, "id_lop" => 9, "chuc_vu" => 0],
            ["id_sinh_vien" => 12, "id_lop" => 9, "chuc_vu" => 0],

            //----------------------------------------------
            // Lớp Chuyên ngành Khoá 23 - Lập trình Website
            ["id_sinh_vien" => 13, "id_lop" => 10, "chuc_vu" => 1],
            ["id_sinh_vien" => 14, "id_lop" => 10, "chuc_vu" => 0],
            ["id_sinh_vien" => 19, "id_lop" => 10, "chuc_vu" => 0],
            ["id_sinh_vien" => 20, "id_lop" => 10, "chuc_vu" => 0],
       
            // Lớp Chuyên Ngành Khoá 23 - Lập trình Mạng máy tính
            ["id_sinh_vien" => 15, "id_lop" => 11, "chuc_vu" => 1],
            ["id_sinh_vien" => 16, "id_lop" => 11, "chuc_vu" => 0],
            ["id_sinh_vien" => 21, "id_lop" => 11, "chuc_vu" => 0],
            ["id_sinh_vien" => 22, "id_lop" => 11, "chuc_vu" => 0],

            // Lớp Chuyên Ngành Khoá 23 - Lập trình Di động
            ["id_sinh_vien" => 17, "id_lop" => 12, "chuc_vu" => 1],
            ["id_sinh_vien" => 18, "id_lop" => 12, "chuc_vu" => 0],
            ["id_sinh_vien" => 23, "id_lop" => 12, "chuc_vu" => 0],
            ["id_sinh_vien" => 24, "id_lop" => 12, "chuc_vu" => 0],

            
        ]);
    }
}
