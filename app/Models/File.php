<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';

    protected $fillable = [
        'id_thong_bao',
        'ten_file',
        'url'
    ];

    public function thongBao()
    {
        return $this->belongsTo(ThongBao::class, 'id_thong_bao', 'id');
    }
}
