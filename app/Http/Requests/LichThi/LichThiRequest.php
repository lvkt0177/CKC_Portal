<?php

namespace App\Http\Requests\LichThi;

use Illuminate\Foundation\Http\FormRequest;

class LichThiRequest extends FormRequest
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
           'id_lop_hoc_phan' => 'required|exists:lop_hoc_phan,id',
            'id_giam_thi_1' => 'required|exists:users,id',
            'id_giam_thi_2' => 'nullable|exists:users,id',
            'id_tuan' => 'required|exists:tuan,id',
            'ngay_thi' => 'required|date_format:Y-m-d',
            'gio_bat_dau' => 'required|date_format:H:i',
            'thoi_gian_thi' => 'required|integer|min:1',
            'id_phong_thi' => 'required|exists:phong,id',
            'lan_thi' => 'required|integer|in:1,2',
            
            
        ];
    }
    public function messages(): array
    {
        return [
            "tuan.required"=> "Tuần phải tồn tại",
            "hoc_ky.required"=> "Học kỳ phải tồn tại",
        ];
    }
}