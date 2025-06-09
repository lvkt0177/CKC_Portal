<?php

namespace App\Http\Requests\GiangVien;

use Illuminate\Foundation\Http\FormRequest;

class NhapDiemRequest extends FormRequest
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
            'diem_chuyen_can' => 'min:0|max:10',
            'diem_qua_trinh' => 'min:0|max:10',
            'diem_thi' => 'min:0|max:10',
            'id_sinh_vien' => 'numeric',
            'id_lop_hoc_phan' => 'numeric',
            'xep_loai'=>'in:A,B,C,D'
        ];
    }
    public function messages(): array
    {
        return [
            'xep_loai.in' => 'Xep loai khong hop le',
            'diem_chuyen_can.min' => 'Phải lớn hơn 0',
            'diem_qua_trinh.min' => 'Phải lớn hơn 0',
            'diem_thi.min' => 'Phải lớn hơn 0',
            'diem_chuyen_can.max' => 'Phải lớn hơn 10',
            'diem_qua_trinh.max' => 'Phải lớn hơn 10',
            'diem_thi.max' => 'Phải lớn hơn 10',
        ];
    }
}