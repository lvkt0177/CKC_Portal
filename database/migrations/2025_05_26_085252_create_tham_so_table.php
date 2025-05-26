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
        Schema::create('tham_so', function (Blueprint $table) {
            $table->id();

            $table->string('ten_tham_so', 100)->unique();

            $table->string('gia_tri', 255);

            $table->string('mo_ta', 255)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tham_so');
    }
};
