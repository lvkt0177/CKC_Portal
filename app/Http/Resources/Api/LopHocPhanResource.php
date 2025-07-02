<?php


namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\ThoiKhoaBieuResource;

class LopHocPhanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ten_hoc_phan' => $this->ten_hoc_phan,
            'id_giang_vien' => $this->id_giang_vien,
            'id_lop' => $this->id_lop,
            'loai_lop_hoc_phan' => $this->loai_lop_hoc_phan,
            'loai_mon' => $this->loai_mon->getLabel(),
            'lop' => $this->lop ? [
                'id' => $this->lop->id,
                'ten' => $this->lop->ten_lop,
            ] : null,
            'giang_vien' => $this->giangVien ? [
                'id' => $this->giangVien->id,
                'ho_ten' => $this->giangVien->hoSo->ho_ten,
            ] : null,
            
        ];
    }
}
