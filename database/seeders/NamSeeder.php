<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nam;

class NamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Nam::insert([
            ['nam_bat_dau' => 2023],
            ['nam_bat_dau' => 2024],
            ['nam_bat_dau' => 2025],
        ]);
    }
}
