<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CastsIntegerIds;

class Khoa extends Model
{
    use CastsIntegerIds;

    protected $table = "khoa";
    protected $fillable = [
        "ten_khoa"
    ];
    /**
     * L t c c ng nh thu c khoa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chuyenNganh()
    {
        return $this->hasMany(Khoa::class, 'id_khoa', 'id');
    }
}