<?php

namespace App\Enum;

enum BienBanStatus:int
{
    /*
        1. Thư ký tạo
        2. Gửi cho Giảng viên chủ nhiệm
        3. Gửi cho CTCT
    */
    case THUKY = 0;
    case GIANGVIEN = 1;
    case CTCT = 2;

    public function getLabel(): string
    {
        return match ($this) {
            self::THUKY => 'Thư ký tạo',
            self::GIANGVIEN => 'Gửi cho Giảng viên chủ nhiệm',
            self::CTCT => 'Gửi cho Phòng CTCT',
        };
    }

    public function getBadge(): string
    {
        return match ($this) {
            self::THUKY => 'success text-white',
            self::GIANGVIEN => 'warning text-dark',
            self::CTCT => 'info text-dark',
        };
    }
}