<?php

namespace App\Enum;

enum ThongBaoStatus:int
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
            self::ACTIVE => 'success',
            self::INACTIVE => 'warning',
        };
    }
}