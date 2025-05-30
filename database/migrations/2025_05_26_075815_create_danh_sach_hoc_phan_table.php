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
        Schema::create('danh_sach_hoc_phan', function (Blueprint $table) {
            //id sinh viên
            $table->foreignId('id_sinh_vien')
                ->constrained('sinhvien')
                ->onDelete('cascade');

            //id lop hoc phan
            $table->foreignId('id_lop_hoc_phan')
                ->constrained('lop_hoc_phan')
                ->onDelete('cascade');

            //DIEM_MD_THUC_HANH = null
            $table->float('diem_md_thuc_hanh')->nullable();
            
            //DIEM_MD_LY_THUYET
            $table->float('diem_md_ly_thuyet')->nullable();
            

            //điểm chuyên cần
            $table->float('diem_chuyen_can')->nullable();

            //điểm quá trình
            $table->float('diem_qua_trinh')->nullable();

            //điểm thi
            $table->float('diem_thi')->nullable();

            //điểm tổng kết
            $table->float('diem_tong_ket')->default(0);

            //loại học
            $table->integer('loai_hoc')->default(0); // 0: học chính thức, 1: học ghép

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danh_sach_hoc_phan');
    }
};
