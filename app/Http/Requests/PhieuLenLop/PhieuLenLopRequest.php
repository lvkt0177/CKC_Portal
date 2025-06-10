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
        return [
            //
            'id_lop_hoc_phan' => 'required|exists:lop_hoc_phan,id',
            'tiet_bat_dau' => 'required|integer',
            'so_tiet' => 'required|integer',
            'ngay' => 'required|date',
            'id_phong' => 'required|exists:phong,id',
            'si_so' => 'required|integer|min:0',
            'hien_dien' => 'required|integer|min:0|max:' . $this->input('si_so'),
            'noi_dung' => 'nullable|string|max:1000',
        ];
    }
    public function messages(): array
    {
        return [
            'id_lop_hoc_phan.required' => 'Lớp học phần khóa',
            'id_lop_hoc_phan.exists' => 'Lớp học phần khóa khóa',
            'id_phong.required' => 'Phòng khóa',
            'id_phong.exists' => 'Phòng khóa khóa',
            'tiet_bat_dau.required' => 'Chọn tiết bắt đầu',
            'so_tiet.required' => 'Chọn số tiết',
            'hien_dien.integer' => 'Hiện diện phái lớn hơn 0',
            'hien_dien.max' => 'Hiện diện phải bé hơn bằng sỉ số',
            'noi_dung.max' => 'Nội dung tối đa 500 ký tự',
            ];
    }
}