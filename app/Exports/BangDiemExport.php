<?php

namespace App\Exports;

use App\Models\DanhSachHocPhan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\LopHocPhan;

class BangDiemExport implements FromCollection, WithHeadings
{
    public function __construct(
        protected LopHocPhan $lopHocPhan
    ) {
        //
    }

    public function collection()
    {
        return DanhSachHocPhan::with(['sinhVien.hoSo', 'lopHocPhan'])
            ->whereHas('lopHocPhan', function ($query) {
                $query->where('id', $this->lopHocPhan->id);
                $query->where('id_lop', $this->lopHocPhan->id_lop);
            })
            ->get()
            ->map(function ($item) {
                return [
                    'ma_sv'         => $item->sinhVien->ma_sv,
                    'ten_sv'        => $item->sinhVien->hoSo->ho_ten,
                    'chuyên cần'    => $item->diem_chuyen_can,
                    'quá trình'       => $item->diem_qua_trinh,
                    'điểm thi lần 1'     => $item->diem_thi_lan_1,
                    'điểm thi lần 2'     => $item->diem_thi_lan_2,
                    'điểm tổng kết'      => $item->diem_tong_ket,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Mã SV',
            'Tên SV',
            'Chuyên cần',
            'Quá trình',
            'Điểm thi lần 1',
            'Điểm thi lần 2',
            'Điểm Tổng kết',
        ];
    }
}
