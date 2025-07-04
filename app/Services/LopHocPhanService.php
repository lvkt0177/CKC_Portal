<?php

namespace App\Services;

use App\Models\LopHocPhan;
use Illuminate\Support\Carbon;

class LopHocPhanService
{
    public function dongCacLopHetHanDangKy()
    {
        $lopHocPhanDangMo = LopHocPhan::with([
            'lop',
            'giangVien.hoSo',
            'thoiKhoaBieu.phong'
        ])->where('trang_thai', 1)->get();

        foreach ($lopHocPhanDangMo as $lop) {
            $tkbDauTien = $lop->thoiKhoaBieu->sortBy(fn($tkb) => $tkb->ngay)->first();

            if ($tkbDauTien) {
                $ngayKetThuc = Carbon::parse($tkbDauTien->ngay)->addWeeks(5);

                if (now()->greaterThanOrEqualTo($ngayKetThuc)) {
                    $lop->trang_thai = 0;
                    $lop->save();
                }
            }
        }
    }
}
