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
        Schema::create('danh_sach_sinh_vien', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_lop')->constrained('lop')->onDelete('cascade');
            $table->foreignId('id_sinh_vien')->constrained('sinhvien')->onDelete('cascade');
            $table->integer('chuc_vu')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danh_sach_sinh_vien');
    }
};
