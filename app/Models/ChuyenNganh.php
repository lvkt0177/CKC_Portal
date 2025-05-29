<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChuyenNganh extends Model
{
    protected $table = "chuyen_nganh";
    protected $fillable = ['ten_chuyen_nganh', 'id_bo_mon', 'trang_thai'];
}