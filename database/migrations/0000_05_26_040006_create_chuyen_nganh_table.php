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
        Schema::create('chuyen_nganh', function (Blueprint $table) {
            $table->id();

            $table->string('ten_chuyen_nganh', 100);

            $table->foreignId('id_khoa')->constrained('khoa')->onDelete('cascade');
            
            $table->foreignId('id_chuyen_nganh_cha')->nullable()->constrained('chuyen_nganh')->onDelete('cascade');

            $table->integer('trang_thai')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chuyen_nganh');
    }
};
