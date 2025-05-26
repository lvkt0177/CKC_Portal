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
        Schema::create('hoc_ky', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_nien_khoa')->constrained('nien_khoa')->onDelete('cascade');

            $table->string('ten_hoc_ky', 100);

            $table->date('ngay_bat_dau');

            $table->date('ngay_ket_thuc');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoc_ky');
    }
};
