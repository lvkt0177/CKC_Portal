<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nam extends Model
{
    //
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