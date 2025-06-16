<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Enum\ActiveOrNotStatus;

class BinhLuan extends Model
{
    protected $table = 'binh_luan';

    protected $fillable = [
        'noi_dung',
        'id_thong_bao',
        'nguoi_binh_luan_id',
        'nguoi_binh_luan_type',
        'id_binh_luan_cha',
        'trang_thai',
    ];

    protected $casts = [
        'trang_thai' => ActiveOrNotStatus::class
    ];

    public function nguoiBinhLuan(): MorphTo
    {
        return $this->morphTo();
    }

    public function thongBao(): BelongsTo
    {
        return $this->belongsTo(ThongBao::class, 'id_thong_bao');
    }

    public function binhLuanCha(): BelongsTo
    {
        return $this->belongsTo(BinhLuan::class, 'id_binh_luan_cha');
    }

    public function binhLuanCon()
    {
        return $this->hasMany(BinhLuan::class, 'id_binh_luan_cha');
    }

    
}
