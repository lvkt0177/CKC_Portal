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
        Schema::create('sinhvien', function (Blueprint $table) {
            $table->id();
            
            $table->string('ma_sv', 20)->unique();
            //id_lop
            $table->foreignId('id_lop')->constrained('lop')->onDelete('cascade');

            $table->foreignId('id_ho_so')->constrained('ho_so')->onDelete('cascade');
            // CHỨC VỤ
            $table->integer('chuc_vu')->default(0); // 0: sinh viên, 1: thư ký
            
            $table->string('password')->nullable();

            $table->integer('trang_thai')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sinhvien');
    }
};