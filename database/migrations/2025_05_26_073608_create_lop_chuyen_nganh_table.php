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
        Schema::create('lop_chuyen_nganh', function (Blueprint $table) {
            $table->id();
            //tên lớp
            $table->string('ten_lop');
            $table->foreignId('id_nien_khoa')->nullable()->constrained('nien_khoa')->onDelete('cascade');
            $table->foreignId('id_gvcn')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('id_chuyen_nganh')->nullable()->constrained('chuyen_nganh')->onDelete('cascade');
            $table->integer('si_so')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lop_chuyen_nganh');
    }
};