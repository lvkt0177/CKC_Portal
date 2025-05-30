<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    //
    protected $table = 'phong';

    protected $fillable = [
        'ten',
        'so_luong',
        'loai_phong',
    ];

}
