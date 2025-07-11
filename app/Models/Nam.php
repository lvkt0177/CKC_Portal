<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CastsIntegerIds;

class Nam extends Model
{
    use CastsIntegerIds;

    protected $table = 'nam';

    protected $fillable = [
        'nam_bat_dau',
    ];
    //tuan
    public function tuan()
    {
        return $this->hasMany(Tuan::class, 'id_nam', 'id');
    }
    //diemRenLuyen
    public function diemRenLuyen()
    {
        return $this->hasMany(DiemRenLuyen::class, 'id_nam', 'id');
    }
}