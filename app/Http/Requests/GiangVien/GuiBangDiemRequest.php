<?php

namespace App\Http\Requests\GiangVien;

use Illuminate\Foundation\Http\FormRequest;

class GuiBangDiemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // hoặc kiểm tra quyền
    }

    public function rules(): array
    {
        return [
            'tieu_de' => 'required',
            'files' => 'required|file|mimes:pdf,xlsx,xls|max:10240',
            'danhSachHocPhan' => 'required|json',
            'noi_dung' => 'required'
        ];
    }
}
