<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lop extends Model
{
    protected $table = 'lop';
    protected $fillable = [
        'ten_lop',
        'id_nien_khoa',
        'id_gvcn',
        'si_so'
    ];
}