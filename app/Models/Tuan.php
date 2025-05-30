<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tuan extends Model
{
    //
    protected $table = 'tuan';

    protected $fillable = [
        'id_nam',
        'tuan',
        'ngay_bat_dau',
        'ngay_ket_thuc',
    ];
}
