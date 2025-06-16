<?php

namespace Database\Seeders;

use App\Models\LoaiGiay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoaiGiaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LoaiGiay::insert([
            [
                'ten_giay' => '📋 Giấy tạm hoãn nghĩa vụ quân sự',
                'trang_thai' => 0,
            ],
            [
                'ten_giay' => '🎓 Giấy bổ túc hồ sơ thuế thu nhập cá nhân',
                'trang_thai' => 0,
            ],
            [
                'ten_giay' => '🚌 Giấy đi xe buýt tháng (do chưa có thẻ SV)',
                'trang_thai' => 0,
            ],
            [
                'ten_giay' => '💳 Giấy vay vốn học sinh sinh viên',
                'trang_thai' => 0,
            ],
            [
                'ten_giay' => '🏠 Giấy bổ túc hồ sơ tạm trú, tạm vắng',
                'trang_thai' => 0,
            ],
            [
                'ten_giay' => '💰 Giấy bổ túc hồ sơ xin học bỗng',
                'trang_thai' => 0,
            ],
        ]);
    }
}