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
        Schema::create('binh_luan', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('nguoi_binh_luan'); 
            $table->foreignId('id_thong_bao')->constrained('thong_bao')->onDelete('cascade');
            $table->longText('noi_dung');
            $table->foreignId('id_binh_luan_cha')->nullable()->constrained('binh_luan')->onDelete('cascade');
            $table->integer('trang_thai')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('binh_luan');
    }
};
