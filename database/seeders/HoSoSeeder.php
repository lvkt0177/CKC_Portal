<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HoSo;
class HoSoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        HoSo::insert([
            [
                'ho_ten' => 'Le Van Khanh Thinh',
                'email' => 'lvkt@fe.edu.vn',
                //password
                'password' => bcrypt('12345678'),
                'so_dien_thoai' => '0857853419',
                'ngay_sinh' => '2000-01-01',
                'gioi_tinh' => 'Nam',
                'cccd' => '0621456789',
                'dia_chi' => '123 Nguyen Van Cu, Hanoi',
                'anh' => 'assets/admin/images/ho_so/user_image.jpg',
            ],
            [
                'ho_ten' => 'Nguyen Thi Mai',
                'email' => 'ntm@fe.edu.vn',
                'password' => bcrypt('12345678'),
                'so_dien_thoai' => '0987654321',
                'ngay_sinh' => '2000-01-01',
                'gioi_tinh' => 'Nu',
                'cccd' => '0684567890',
                'dia_chi' => '24 Ly Thuong Kiet, Hanoi',
                'anh' => 'assets/admin/images/ho_so/user_image.jpg',
            ],
            [
                'ho_ten' => 'Tran Van An',
                'email' => 'tva@fe.edu.vn',
                'password' => bcrypt('12345678'),
                'so_dien_thoai' => '0123456789',
                'ngay_sinh' => '2000-01-01',
                'gioi_tinh' => 'Nam',
                'cccd' => '0690123456',
                'dia_chi' => '999 Vo Nguyen Giap, Hanoi',
                'anh' => 'assets/admin/images/ho_so/user_image.jpg',
            ],
            [
                'ho_ten' => 'Sinh Viên 1',
                'email' => 'sv_1@fe.edu.vn',
                'password' => bcrypt('12345678'),
                'so_dien_thoai' => '0123456700',
                'ngay_sinh' => '2000-01-01',
                'gioi_tinh' => 'Nam',
                'cccd' => '06901234001',
                'dia_chi' => '999 Vo Nguyen Giap, Hanoi',
                'anh' => 'assets/fe/images/ho_so/profile.jpg',
            ],
            [
                'ho_ten' => 'Sinh Viên 2',
                'email' => 'sv_2@fe.edu.vn',
                'password' => bcrypt('12345678'),
                'so_dien_thoai' => '0123456701',
                'ngay_sinh' => '2000-01-01',
                'gioi_tinh' => 'Nam',
                'cccd' => '06901234002',
                'dia_chi' => '999 Nguyễn Tất Thành, Hanoi',
                'anh' => 'assets/fe/images/ho_so/profile.jpg',
            ],
            [
                'ho_ten' => 'Sinh Viên 3',
                'email' => 'sv_3@fe.edu.vn',
                'password' => bcrypt('12345678'),
                'so_dien_thoai' => '0123456703',
                'ngay_sinh' => '2000-01-01',
                'gioi_tinh' => 'Nam',
                'cccd' => '06901234003',
                'dia_chi' => '9 Nguyễn Tất Thành, Hanoi',
                'anh' => 'assets/fe/images/ho_so/profile.jpg',
            ],
            [
                'ho_ten' => 'Giảng Viên 1',
                'email' => 'gv_1@fe.edu.vn',
                'password' => bcrypt('12345678'),
                'so_dien_thoai' => '012345673333',
                'ngay_sinh' => '2000-01-01',
                'gioi_tinh' => 'Nam',
                'cccd' => '06901234009',
                'dia_chi' => '9 Hội An, Đà Nẵng',
                'anh' => 'assets/fe/images/ho_so/profile.jpg',
            ],
            [
                'ho_ten' => 'Giảng Viên 2',
                'email' => 'gv_2@fe.edu.vn',
                'password' => bcrypt('12345678'),
                'so_dien_thoai' => '01234569904',
                'ngay_sinh' => '2000-01-01',
                'gioi_tinh' => 'Nam',
                'cccd' => '06901234008',
                'dia_chi' => '9 Yên Lãng, Hanoi',
                'anh' => 'assets/fe/images/ho_so/profile.jpg',
            ],



        ]);
    }
}