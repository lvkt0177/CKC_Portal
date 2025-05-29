<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::insert([
            [
                'id_ho_so' => 1,
                'tai_khoan' => 'lvkt0177',
                'password' => bcrypt('Thinh3988@'),
                'trang_thai' => 1,
            ],
            [
                'id_ho_so' => 2,
                'tai_khoan' => 'mdt0177',
                'password' => bcrypt('Thinh3988@'),
                'trang_thai' => 1,
            ],
            [
                'id_ho_so' => 3,
                'tai_khoan' => 'nv1',
                'password' => bcrypt('Thinh3988@'),
                'trang_thai' => 1,
            ],
        ]);
    }
}
