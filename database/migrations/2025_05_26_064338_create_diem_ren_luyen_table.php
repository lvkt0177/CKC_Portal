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
        Schema::create('diem_ren_luyen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_gvcn')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_sinh_vien')->constrained('sinhvien')->onDelete('cascade');
            $table->integer('xep_loai')->default(0); // 0: Chưa đánh giá, 1: A, 2: B, 3: C
            $table->date('thoi_gian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diem_ren_luyen');
    }
};
