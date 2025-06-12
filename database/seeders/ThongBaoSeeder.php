<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ThongBao;
use Carbon\Carbon;

class ThongBaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThongBao::insert([
            [
                'id_gv'      => 1,
                'tu_ai'      => 'khoa',
                'ngay_gui'   => Carbon::now()->subDays(2)->format('Y-m-d'),
                'tieu_de'    => 'Thông báo 1',
                'noi_dung'   => 'Nội dung thông báo 1',
                'trang_thai' => 1,
            ],
            [
                'id_gv'      => 2,
                'tu_ai'      => 'khoa',
                'ngay_gui'   => Carbon::now()->subDays(4)->format('Y-m-d'),
                'tieu_de'    => 'Thông báo 2',
                'noi_dung'   => 'Nội dung thông báo 2',
                'trang_thai' => 0,
            ],
            [
                'id_gv'      => 3,
                'tu_ai'      => 'khoa',
                'ngay_gui'   => Carbon::now()->subDays(6)->format('Y-m-d'),
                'tieu_de'    => 'Thông báo 3',
                'noi_dung'   => 'Nội dung thông báo 3',
                'trang_thai' => 1,
            ],
            [
                'id_gv'      => 4,
                'tu_ai'      => 'khoa',
                'ngay_gui'   => Carbon::now()->subDays(1)->format('Y-m-d'),
                'tieu_de'    => 'Thông báo 4',
                'noi_dung'   => 'Nội dung thông báo 4',
                'trang_thai' => 1,
            ],
            [
                'id_gv'      => 5,
                'tu_ai'      => 'khoa',
                'ngay_gui'   => Carbon::now()->format('Y-m-d'),
                'tieu_de'    => 'Thông báo 5',
                'noi_dung'   => 'Nội dung thông báo 5',
                'trang_thai' => 0,
            ],
        ]);
    }
}
