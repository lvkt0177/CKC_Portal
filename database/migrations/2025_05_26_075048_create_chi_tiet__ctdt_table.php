<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chi_tiet_ctdt', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_chuong_trinh_dao_tao')->constrained('chuong_trinh_dao_tao')->onDelete('cascade');

            $table->foreignId('id_mon_hoc')->constrained('mon_hoc')->onDelete('cascade');

            $table->foreignId('id_hoc_ky')->constrained('hoc_ky')->onDelete('cascade');

            $table->integer('so_tiet')->nullable()->default(0);

            $table->integer('so_tin_chi')->nullable()->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet__c_t_d_t');
    }
};