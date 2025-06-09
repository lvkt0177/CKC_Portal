<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiemRenLuyenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DỉemRenLuyen::insert([
            [
                'id_gvcn'=>1,
                'id_sinh_vien'=>1,
                'xep_loai'=>'A',
                'thoi_gian'=>now()->format('m'),
            ]
        ]);
    }
}