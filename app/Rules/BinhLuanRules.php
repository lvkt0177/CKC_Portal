<?php

namespace App\Rules;

use App\Models\BinhLuan;
use Illuminate\Validation\Validator;

class BinhLuanRules
{
    public static function rules(): array
    {
        return [
            'noi_dung' => 'required|string|max:500',
            'id_binh_luan_cha' => 'nullable|exists:binh_luan,id',
        ];
    }

    public static function messages(): array
    {
        return [
            'id_binh_luan_cha.exists' => 'Bình luận cha không tồn tại',
            'noi_dung.max' => 'Nội dung tối đa 500 ký tự.',
        ];
    }
    
}
