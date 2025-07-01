<?php

namespace App\Services;

use App\Models\ThoiKhoaBieu;

class ThoiKhoaBieuService
{
    public function isTrungTiet(array $data, ?int $ignoreId = null): bool
    {
        $query = ThoiKhoaBieu::where('id_phong', $data['id_phong'])
            ->where('id_tuan', $data['id_tuan'])
            ->where('ngay', $data['ngay']);


        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        $query->where(function ($q) use ($data) {
            $q->whereBetween('tiet_bat_dau', [$data['tiet_bat_dau'], $data['tiet_ket_thuc']])
              ->orWhereBetween('tiet_ket_thuc', [$data['tiet_bat_dau'], $data['tiet_ket_thuc']])
              ->orWhere(function ($q2) use ($data) {
                  $q2->where('tiet_bat_dau', '<=', $data['tiet_bat_dau'])
                     ->where('tiet_ket_thuc', '>=', $data['tiet_ket_thuc']);
              });
        });

        return $query->exists();
    }
}
