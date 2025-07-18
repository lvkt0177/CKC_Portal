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
        Schema::create('bo_mon', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_chuyen_nganh')->constrained('chuyen_nganh')->onDelete('cascade');
            $table->string('ten_bo_mon')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bo_mon');
    }
};
