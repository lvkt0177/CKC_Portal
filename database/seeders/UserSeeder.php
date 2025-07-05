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
                'id_ho_so' => 37,
                'id_bo_mon' => 1,
                'tai_khoan' => 'lvkt0177',
                'password' => Hash::make('Thinh3988@'),
                'trang_thai' => 1,
            ],
            [
                'id_ho_so' => 38,
                'id_bo_mon' => 2,
                'tai_khoan' => 'mdt0177',
                'password' => Hash::make('Thinh3988@'),
                'trang_thai' => 1,
            ],
            [
                'id_ho_so' => 39,
                'id_bo_mon' => 2,
                'tai_khoan' => 'nv1',
                'password' => Hash::make('Thinh3988@'),
                'trang_thai' => 1,
            ],
            [
                'id_ho_so' => 40,
                'id_bo_mon' => 2,
                'tai_khoan' => 'gv3',
                'password' => Hash::make('Thinh3988@'),
                'trang_thai' => 1,
            ],
            
            
        ]);
    }
}