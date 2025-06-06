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
            'diem_chuyen_can' => 'required|numeric|min:0|max:10',
            'diem_qua_trinh' => 'required|numeric|min:0|max:10',
            'diem_thi' => 'required|numeric|min:0|max:10',
            'id_sinh_vien' => 'numeric',
            'id_lop_hoc_phan' => 'numeric',
        ];
    }
    public function messages(): array
    {
        return [
            'diem_chuyen_can.required' => 'Không được được trống ',
            'diem_qua_trinh.required' => 'Không được được trống',
            'diem_thi.required' => 'Không được được trống',
            'diem_chuyen_can.numeric' => 'Phải là số',
            'diem_qua_trinh.mumeric' => 'Phải là số',
            'diem_thi.numeric' => 'Phải là số',
            'diem_chuyen_can.min' => 'Phải lớn hơn 0',
            'diem_qua_trinh.min' => 'Phải lớn hơn 0',
            'diem_thi.min' => 'Phải lớn hơn 0',
            'diem_chuyen_can.max' => 'Phải lớn hơn 10',
            'diem_qua_trinh.max' => 'Phải lớn hơn 10',
            'diem_thi.max' => 'Phải lớn hơn 10',
        ];
    }
}