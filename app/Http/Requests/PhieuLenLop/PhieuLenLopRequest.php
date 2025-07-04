<?php

namespace App\Http\Requests\PhieuLenLop;

use Illuminate\Foundation\Http\FormRequest;

class PhieuLenLopRequest extends FormRequest
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
        $lopHocPhan = \App\Models\LopHocPhan::find($this->input('id_lop_hoc_phan'));
        $siSo = $lopHocPhan?->so_luong_sinh_vien ?? 0;
        return [
            'id_lop_hoc_phan' => 'required|exists:lop_hoc_phan,id',
            'hien_dien' => 'required|integer|min:0|max:' . $siSo,
            'noi_dung' => 'nullable|string|max:1000',
        ];
    }
    public function messages(): array
    {
        return [
            'id_lop_hoc_phan.required' => 'Chọn lớp học phần',
            'id_lop_hoc_phan.exists' => 'Lớp học phần khóa khóa',
            'hien_dien.required' => 'Nhập hiện diện',
            'hien_dien.integer' => 'Hiện diện phái lớn hơn 0',
            'hien_dien.max' => 'Hiện diện phải bé hơn bằng sỉ số',
            'noi_dung.max' => 'Nội dung tối đa 500 ký tự',
            ];
    }
}