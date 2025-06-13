<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\DiemRenLuyen;
class DiemRenLuyenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DiemRenLuyen::insert([
            [
                'id_gvcn'=>1,
                'id_sinh_vien'=>1,
                'xep_loai'=>1,
                'thoi_gian'=>1,
            ],
            [
                'id_gvcn'=>1,
                'id_sinh_vien'=>1,
                'xep_loai'=>1,
                'thoi_gian'=>2,
            ],
            [
                'id_gvcn'=>1,
                'id_sinh_vien'=>1,
                'xep_loai'=>1,
                'thoi_gian'=>3,
            ],
            [
                'id_gvcn'=>1,
                'id_sinh_vien'=>1,
                'xep_loai'=>1,
                'thoi_gian'=>4,
            ],
            [
                'id_gvcn'=>1,
                'id_sinh_vien'=>1,
                'xep_loai'=>1,
                'thoi_gian'=>5,
            ],
            [
                'id_gvcn'=>null,
                'id_sinh_vien'=>1,
                'xep_loai'=>0,
                'thoi_gian'=>6,
            ],
            [
                'id_gvcn'=>null,
                'id_sinh_vien'=>2,
                'xep_loai'=>0,
                'thoi_gian'=>7,
            ]
        ]);
    }
}