<?php

namespace App\Enum;

enum LoaiTaiKhoan:int
{
    case EMAIL = 0;
    case PORTAL = 1;

    public function getLabel(): string
    {
        return match ($this) {
            self::EMAIL => 'Email',
            self::PORTAL => 'Portal',
        };
    }

    public function getBadge(): string
    {
        return match ($this) {
            self::EMAIL => 'success',
            self::PORTAL => 'warning',
        };
    }
}