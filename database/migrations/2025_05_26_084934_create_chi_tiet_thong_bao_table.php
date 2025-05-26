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
        Schema::create('chi_tiet_thong_bao', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_thong_bao')->constrained('thong_bao')->onDelete('cascade');

            $table->foreignId('id_sinh_vien')->constrained('sinhvien')->onDelete('cascade');

            $table->integer('trang_thai')->default(0); // 0: chưa đọc, 1: đã đọc

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_thong_bao');
    }
};
