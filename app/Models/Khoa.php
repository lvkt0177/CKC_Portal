<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Khoa extends Model
{
    protected $table = "khoa";
    protected $fillable = [
        "ten_khoa"
    ];
    public function nganhHoc()
    {
        return $this->hasMany(Khoa::class, 'id_khoa', 'id');
    }
}