<?php

namespace App\Enum;

enum BienBanStatus:int
{
    case ACTIVE = 1;
    case INACTIVE = 0;

    public function getLabel(): string
    {
        return match ($this) {
            self::ACTIVE => 'Đã gửi',
            self::INACTIVE => 'Chưa gửi',
        };
    }

    public function getBadge(): string
    {
        return match ($this) {
            self::ACTIVE => 'success text-white',
            self::INACTIVE => 'warning text-dark',
        };
    }
}