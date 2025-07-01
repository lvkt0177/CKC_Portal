<?php

namespace App\Enum;

enum NopBangDiemStatus:int
{
    case MACDINH = 0;
    case NOPLANMOT = 1;
    case NOPLANHAI = 2;
    case NOPLANBA = 3;

    public function getLabel(): string
    {
        return match ($this) {
            self::MACDINH => 'Mặc định',
            self::NOPLANMOT => 'Nộp bảng điểm',
            self::NOPLANHAI => 'Nộp bảng điểm thi lần 1',
            self::NOPLANBA => 'Nộp bảng điểm thi lần 2',
        };
    }
}