<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoMon extends Model
{
    protected $table = "bo_mon";
    protected $fillable = [
        'id_nganh_hoc',
        'ten_bo_mon'
    ];
    public function users()
    {
        return $this->hasMany(User::class, 'id_bo_mon', 'id');
    }
    public function nganhHoc()
    {
        return $this->belongsTo(NganhHoc::class, 'id_nganh_hoc', 'id');
    }

}