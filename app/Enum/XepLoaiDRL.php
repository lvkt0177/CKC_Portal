<?php

namespace App\Enum;

enum XepLoaiDRL:int
{
    //
    case ChuaXepLoai = 0;
    case A = 1;
    case B = 2;
    case C = 3;
    case D = 4;

    public function getLabel(): string
    {
        return match ($this) {
            self::ChuaXepLoai => 'Chưa xếp loại', 
            self::A => 'A',
            self::B => 'B',
            self::C => 'C',
            self::D => 'D',
        };
    }
}