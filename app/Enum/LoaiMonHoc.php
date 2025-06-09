<?php

namespace App\Enum;

enum LoaiMonHoc:int
{
    case LYTHUYET = 0;
    case THUCHANH = 1;
    case DAICUONG = 2;
    case MODUN = 3;
    

    public function getLabel(): string
    {
        return match ($this) {
            self::LYTHUYET => 'Lý thuyết',
            self::THUCHANH => 'Thực hành',
            self::DAICUONG => 'Đại cương',
            self::MODUN => 'Módun',
        };
    }

    public function getBadge(): string
    {
        return match ($this) {
            self::LYTHUYET => 'info',
            self::THUCHANH => 'warning',
            self::DAICUONG => 'danger',
            self::MODUN => 'success',
        };
    }
}