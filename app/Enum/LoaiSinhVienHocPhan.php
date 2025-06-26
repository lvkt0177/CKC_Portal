<?php

namespace App\Enum;

enum LoaiSinhVienHocPhan:int
{
    case CHINHQUY = 0;
    case HOCGHEP = 1;

    public function getLabel(): string
    {
        return match ($this) {
            self::CHINHQUY => 'Chính quy',
            self::HOCGHEP => 'Học ghép',
           
        };
    }

    public function getBadge(): string
    {
        return match ($this) {
            self::CHINHQUY => 'success text-white',
            self::HOCGHEP => 'warning text-dark',
           
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::CHINHQUY => 'fas fa-check-circle me-1', 
            self::HOCGHEP => 'fas fa-times-circle me-1', 
        };
    }
}