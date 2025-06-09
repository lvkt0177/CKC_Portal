<?php

namespace App\Enum;

enum LoaiPhong:int
{
    case PHONGLYTHUET = 0;
    case PHONGTHUCHANH = 1;
    case PHONGONLINE = 2;

    public function getLabel(): string
    {
        return match ($this) {
            self::PHONGLYTHUET => 'Phòng lý thuyết',
            self::PHONGTHUCHANH => 'Phòng thực hành',
            self::PHONGONLINE => 'Phòng online',
        };
    }

    public function getBadge(): string
    {
        return match ($this) {
            self::PHONGLYTHUET => 'info',
            self::PHONGTHUCHANH => 'warning',
            self::PHONGONLINE => 'success',
        };
    }
}
