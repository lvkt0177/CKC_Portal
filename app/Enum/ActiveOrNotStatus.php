<?php

namespace App\Enum;

enum ActiveOrNotStatus:int
{
    case ACTIVE = 0;
    case INACTIVE = 1;

    public function getLabel(): string
    {
        return match ($this) {
            self::ACTIVE => 'Hoạt động',
            self::INACTIVE => 'Khóa',
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
