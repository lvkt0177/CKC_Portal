<?php

namespace App\Enum;

enum LoaiDangKy:int
{
    case HOCGHEP = 0;
    case THILAI = 1;

    public function getLabel(): string
    {
        return match ($this) {
            self::HOCGHEP => 'Học ghép',
            self::THILAI => 'Thi lại',
           
        };
    }

    public function getBadge(): string
    {
        return match ($this) {
            self::HOCGHEP => 'success text-white',
            self::THILAI => 'warning text-dark',
           
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::HOCGHEP => 'fas fa-check-circle me-1', 
            self::THILAI => 'fas fa-times-circle me-1', 
        };
    }
}