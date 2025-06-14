<?php

namespace App\Http\Requests\GiangVien;

use Illuminate\Foundation\Http\FormRequest;

class NhapDiemRenLuyenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
           
            'id_sinh_vien' => 'numeric',
            'id_lop_hoc_phan' => 'numeric',
            'xep_loai'=>'in:1,2,3,4',
            'thoi_gian' => 'in:1,2,3,4,5,6,7,8,9,10,11,12',
            'nam'=>'numeric',
            //mảng sinh viên
            
        ];
    }
    public function messages(): array
    {
        return [
            'xep_loai.in' => 'Xep loai khong hop le',
            'thoi_gian.in' => 'Thoi gian khong hop le',
            
        ];
    }
}