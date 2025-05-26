<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chi_tiet_bien_ban_ctdt', function (Blueprint $table) {
            
            //id_bien_ban_shcn
            $table->foreignId('id_bien_ban_shcn')->constrained('bien_ban_shcn')->onDelete('cascade');

            //id_sinh_vien
            $table->foreignId('id_sinh_vien')->constrained('sinhvien')->onDelete('cascade');

            //lý do
            $table->integer('ly_do')->default(0); // 0: có phép, 1: không phép

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_bien_ban_ctdt');
    }
};
