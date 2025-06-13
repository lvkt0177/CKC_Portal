<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BinhLuan;
use Illuminate\Support\Carbon;
use App\Enum\ActiveOrNotStatus;

class BinhLuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BinhLuan::insert([
            [
                'noi_dung' => 'Bình luận của user admin',
                'nguoi_binh_luan_id' => 1,
                'nguoi_binh_luan_type' => 'App\Models\User',
                'id_thong_bao' => 1,
                'id_binh_luan_cha' => null,
                'trang_thai' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'noi_dung' => 'Bình luận của sinh viên',
                'nguoi_binh_luan_id' => 1,
                'nguoi_binh_luan_type' => 'App\Models\SinhVien',
                'id_thong_bao' => 1,
                'id_binh_luan_cha' => null,
                'trang_thai' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'noi_dung' => 'Phản hồi của admin cho sinh viên',
                'nguoi_binh_luan_id' => 1,
                'nguoi_binh_luan_type' => 'App\Models\User',
                'id_thong_bao' => 1,
                'id_binh_luan_cha' => 2, 
                'trang_thai' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
