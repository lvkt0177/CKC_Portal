<?php

namespace App\Services;

use App\Models\LichThi;
use Carbon\Carbon;

class LichThiService
{
    public function isTrungLich(array $data, ?int $ignoreId = null): bool
    {
        $start = Carbon::createFromFormat('H:i', $data['gio_bat_dau']);
        $end = $start->copy()->addMinutes($data['thoi_gian_thi']);

        $query = LichThi::where('ngay_thi', $data['ngay_thi'])
            ->where('id_phong_thi', $data['id_phong_thi']);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        $query->where(function ($q) use ($start, $end) {
            $q->whereRaw("TIME(gio_bat_dau) BETWEEN ? AND ?", [$start->format('H:i'), $end->subMinute()->format('H:i')])
              ->orWhereRaw("ADDTIME(gio_bat_dau, SEC_TO_TIME(thoi_gian_thi * 60)) BETWEEN ? AND ?", [$start->format('H:i'), $end->format('H:i')])
              ->orWhereRaw("TIME(gio_bat_dau) <= ? AND ADDTIME(gio_bat_dau, SEC_TO_TIME(thoi_gian_thi * 60)) >= ?", [$start->format('H:i'), $end->format('H:i')]);
        });

        return $query->exists();
    }
}
