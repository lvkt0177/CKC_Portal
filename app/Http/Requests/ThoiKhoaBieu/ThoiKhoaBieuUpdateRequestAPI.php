<?php

namespace App\Http\Requests\ThoiKhoaBieu;

use Illuminate\Foundation\Http\FormRequest;

class ThoiKhoaBieuUpdateRequestAPI extends FormRequest
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
            'id_tuan' => 'required|exists:tuan,id',
            'id_lop_hoc_phan' => 'required|exists:lop_hoc_phan,id',
            'id_phong' => 'required|exists:phong,id',
            'tiet_bat_dau' => 'required|integer|min:1|max:15',
            'tiet_ket_thuc' => 'required|integer|min:1|max:15',
            'ngay' => 'required|date_format:Y-m-d',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $batDau = $this->input('tiet_bat_dau');
            $ketThuc = $this->input('tiet_ket_thuc');

            if (is_numeric($batDau) && is_numeric($ketThuc)) {
                if ($batDau >= $ketThuc) {
                    $validator->errors()->add('tiet_bat_dau', 'Tiết bắt đầu phải nhỏ hơn tiết kết thúc.');
                }
            }
        });
    }
}