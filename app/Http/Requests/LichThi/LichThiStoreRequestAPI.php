<?php

namespace App\Http\Requests\LichThi;

use Illuminate\Foundation\Http\FormRequest;

class LichThiStoreRequestAPI extends FormRequest
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
            'id_lop_hoc_phan' => 'required|exists:lophocphan,id',
            'id_giam_thi_1' => 'required|exists:users,id',
            'id_giam_thi_2' => 'nullable|exists:users,id',
            'ngay_thi' => 'required|date',
            'gio_bat_dau' => 'required|date_format:H:i',
            'thoi_gian_thi' => 'required|integer|min:1',
            'id_phong_thi' => 'required|exists:phong,id',
            'lan_thi' => 'required|integer|in:1,2',
            'trang_thai' => 'required|in:0,1',
        ];
    }
    
}