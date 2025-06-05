<?php

namespace App\Enum;

use App\Traits\EnumValues;
use App\Traits\EnumOptions;

enum Gender: string
{
    use EnumValues, EnumOptions;

    case MALE = 'Nam';
    case FEMALE = 'Nữ';

    public function getLabel(): string
    {
        return match ($this) {
            self::MALE => 'Nam', 
            self::FEMALE => 'Nữ', 
        };
    }
}
