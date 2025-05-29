<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NganhHoc extends Model
{
    protected $table = "nganh_hoc";
    protected $fillable = [
        'id_khoa',
        'ten_nganh'
    ];
    public function boMon()
    {
        return $this->hasMany(BoMon::class, 'id_nganh_hoc', 'id');
    }
    public function khoa()
    {
        return $this->belongsTo(Khoa::class, 'id_khoa', 'id');
    }
}