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
            'students' => ['required', 'array'],
            'students.*' => ['required', 'integer', 'exists:sinhvien,id'],

            'id_lop_hoc_phan' => ['required', 'integer', 'exists:lop_hoc_phan,id'],

            'diem_chuyen_can' => ['nullable', 'array'],
            'diem_chuyen_can.*' => ['nullable', 'numeric', 'between:0,10'],

            'diem_qua_trinh' => ['nullable', 'array'],
            'diem_qua_trinh.*' => ['nullable', 'numeric', 'between:0,10'],

            'diem_thi' => ['nullable', 'array'],
            'diem_thi.*' => ['nullable', 'numeric', 'between:0,10'],
            'nam'=>'numeric',
            //mảng sinh viên
            
        ];
    }
    public function messages(): array
    {
        return [
            'students.required' => 'Vui lòng chọn ít nhất một sinh viên.',
            'students.*.integer' => 'ID sinh viên không hợp lệ.',
            'sstudents.*.exists' => 'Sinh viên không tồn tại trong hệ thống.',
            '*.numeric' => 'Điểm phải là số.',
            '*.between' => 'Điểm phải nằm trong khoảng từ 0 đến 10.',
        ];
    }
}