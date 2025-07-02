<?php


namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class ThoiKhoaBieuResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'id_tuan' => $this->id_tuan,
            'id_lop_hoc_phan' => $this->id_lop_hoc_phan,
            'id_phong' => $this->id_phong,
            'tiet_bat_dau' => $this->tiet_bat_dau,
            'tiet_ket_thuc' => $this->tiet_ket_thuc,
            'ngay' => $this->ngay,
            'phong' => $this->phong ? [
                'id' => $this->phong->id,
                'ten' => $this->phong->ten,
                'so_luong' => $this->phong->so_luong,
                'loai_phong' => $this->phong->loai_phong,
            ] : null,
            'tuan' => $this->tuan ? [
                'id' => $this->tuan->id,
                'tuan' => $this->tuan->tuan,
                'id_nam' => $this->tuan->id_nam,
                'ngay_bat_dau' => $this->tuan->ngay_bat_dau,
                'ngay_ket_thuc' => $this->tuan->ngay_ket_thuc,
            ] : null,
            'lop_hoc_phan' => LopHocPhanResource::make($this->whenLoaded('lopHocPhan')),
        ];
    }
}
