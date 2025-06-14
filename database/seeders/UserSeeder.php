<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //factory
       
        User::insert([
            [
                'id_ho_so' => 1,
                'id_bo_mon' => 1,
                'tai_khoan' => 'lvkt0177',
                'password' => Hash::make('Thinh3988@'),
                'trang_thai' => 1,
            ],
            [
                'id_ho_so' => 2,
                'id_bo_mon' => 2,
                'tai_khoan' => 'mdt0177',
                'password' => Hash::make('Thinh3988@'),
                'trang_thai' => 1,
            ],
            [
                'id_ho_so' => 3,
                'id_bo_mon' => 2,
                'tai_khoan' => 'nv1',
                'password' => Hash::make('Thinh3988@'),
                'trang_thai' => 1,
            ],
            [
                'id_ho_so' => 9,
                'id_bo_mon' => 2,
                'tai_khoan' => 'gv3',
                'password' => Hash::make('Thinh3988@'),
                'trang_thai' => 1,
            ],
            [
                'id_ho_so' => 10,
                'id_bo_mon' => 1,
                'tai_khoan' => 'gv4',
                'password' => Hash::make('Thinh3988@'),
                'trang_thai' => 1,
            ],
            [
                'id_ho_so' => 11,
                'id_bo_mon' => 3,
                'tai_khoan' => 'gv5',
                'password' => Hash::make('Thinh3988@'),
                'trang_thai' => 1,
            ],
            [
                'id_ho_so' => 12,
                'id_bo_mon' => 2,
                'tai_khoan' => 'gv6',
                'password' => Hash::make('Thinh3988@'),
                'trang_thai' => 1,
            ],
            [
                'id_ho_so' => 13,
                'id_bo_mon' => 2,
                'tai_khoan' => 'gv7',
                'password' => Hash::make('Thinh3988@'),
                'trang_thai' => 1,
            ],
            
        ]);
    }
}