<?php

namespace App\Enum;

enum DocThongBao:int
{
    case CHUADOC = 0;
    case DADOC = 1;

    public function getLabel(): string
    {
        return match ($this) {
            self::CHUADOC => 'Chưa đọc',
            self::DADOC => 'Đã đọc',
        };
    }

    public function getBadge(): string
    {
        return match ($this) {
            self::DADOC => 'bg-secondary',
            self::CHUADOC => 'bg-danger',
        };
    }
}