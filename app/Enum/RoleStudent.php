<?php

namespace App\Enum;

use App\Traits\EnumValues;
use App\Traits\EnumOptions;

enum RoleStudent:int
{
    use EnumValues, EnumOptions;

    case MEMBER = 0;
    case SECRETARY = 1;

    public function getLabel(): string
    {
        return match ($this) {
            self::MEMBER => 'Thành viên', 
            self::SECRETARY => 'Thư ký', 
        };
    }

    public function getBadge(): string
    {
        return match ($this) {
            self::MEMBER => 'success',
            self::SECRETARY => 'warning',
        };
    }
}
