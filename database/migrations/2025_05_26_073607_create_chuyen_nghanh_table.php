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
        Schema::create('chuyen_nghanh', function (Blueprint $table) {
            $table->id();

            $table->string('ten_chuyen_nghanh', 100);
            
            $table->foreignId('id_bo_mon')->constrained('bo_mon')->onDelete('cascade');

            $table->integer('trang_thai')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chuyen_nghanh');
    }
};
