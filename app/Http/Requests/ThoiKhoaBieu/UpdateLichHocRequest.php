<?php

namespace App\Http\Requests\ThoiKhoaBieu;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class UpdateLichHocRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }




    public function rules(): array
    {
        return [
            'tuan' => ['required', 'integer'],
            'id_lop_hoc_phan' => ['required', 'integer', 'exists:lop_hoc_phan,id'],
            'id_lop' => ['required', 'integer', 'exists:lop,id'],
            'id_phong' => ['nullable', 'integer', 'exists:phong,id'],
            'id_giao_vien' => [ 'nullable','integer', 'exists:users,id'],
            'ngay_ban_dau' => ['nullable', 'date'],
            'ngay' => ['nullable', 'date'], 
        ];
    }
    protected function failedValidation(Validator $validator)
{
    throw new HttpResponseException(response()->json([
        'errors' => $validator->errors()
    ], 422));
}
  

    public function messages(): array
    {
        return [
            'tuan.required' => 'Vui lòng chọn tuần.',
            'id_lop_hoc_phan.required' => 'Thiếu lớp học phần.',
            'id_lop.required' => 'Thiếu lớp.',
            'id_phong'=>'Phòng không hợp lệ.',
            'id_giao_vien' => 'Giảng viên không hợp lệ.',
            'ngay' => 'Ngày học không hợp lệ.',
        ];
    }
}