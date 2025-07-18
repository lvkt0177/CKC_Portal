<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CastsIntegerIds;

class BoMon extends Model
{
    use CastsIntegerIds;

    protected $table = "bo_mon";
    protected $fillable = [
        'id_chuyen_nganh',
        'ten_bo_mon'
    ];
    public function users()
    {
        return $this->hasMany(User::class, 'id_bo_mon', 'id');
    }
    public function chuyenNganh()
    {
        return $this->belongsTo(ChuyenNganh::class, 'id_chuyen_nganh', 'id');
    }

}