<?php


namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiemRenLuyenResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'id_sinh_vien' => $this->id_sinh_vien,
            'id_nam' => $this->id_nam,
            'xep_loai' => $this->xep_loai->getLabel(),
            'thoi_gian' => $this->thoi_gian,
            'nam_hoc' => $this->nam ? [
                'id' => $this->nam->id,
                'nam_bat_dau' => $this->nam->nam_bat_dau,
            ] : null,
        ];
    }
}
