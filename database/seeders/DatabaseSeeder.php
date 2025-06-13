<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([


            NienKhoaSeeder::class,
            NamSeeder::class,
            TuanSeeder::class,
            PhongSeeder::class,
            HoSoSeeder::class,
            KhoaSeeder::class,
            NganhHocSeeder::class,
            ChuyenNganhSeeder::class,
            BoMonSeeder::class,
            ChuongTrinhDaoTaoSeeder::class,
            HocKySeeder::class,
            MonHocSeeder::class,
            ChiTietChuongTrinhDaoTaoSeeder::class,
            ChuyenNganhSeeder::class,
            UserSeeder::class,
            LopSeeder::class,
            LopHocPhanSeeder::class,
            PhieuLenLopSeeder::class,
            SinhVienSeeder::class,
            DanhSachHocPhanSeeder::class,
            LoaiGiaySeeder::class,
            DangKytGiaySeeder::class,
            RolePermissionSeeder::class,
            BienBanSHCNSeeder::class,
            DiemRenLuyenSeeder::class,
            ThongBaoSeeder::class,
            BinhLuanSeeder::class,
        ]);

    }
}