<?php

namespace App\Enum;

enum CapTren: string
{
    case KHOA = 'khoa';
    case PHONG_CTCT = 'phong_ctct';
    case GVCN = 'gvcn';
    case GVBM = 'gvbm';

    public function getLabel(): string
    {
        return match ($this) {
            self::KHOA => 'Khoa', 
            self::PHONG_CTCT => 'Phòng Công Tác Chính Trị', 
            self::GVCN => 'Giáo viên chủ nhiệm', 
            self::GVBM => 'Giáo viên bộ môn', 
        };
    }
}
