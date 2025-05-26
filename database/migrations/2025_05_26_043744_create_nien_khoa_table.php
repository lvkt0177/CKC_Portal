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
        Schema::create('nien_khoa', function (Blueprint $table) {
            $table->id();
            $table->string('ten_nien_khoa', 50)->unique();
            $table->year('nam_bat_dau');
            $table->year('nam_ket_thuc');
            $table->integer('trang_thai')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nien_khoa');
    }
};
