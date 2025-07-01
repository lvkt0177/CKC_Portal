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
            'id_lop_hoc_phan' => 'required|exists:lop_hoc_phan,id',
            'id_giam_thi_1' => 'required|exists:users,id',
            'id_giam_thi_2' => 'nullable|exists:users,id',
            'id_tuan' => 'required|exists:tuan,id',
            'ngay_thi' => 'required|date_format:Y-m-d',
            'gio_bat_dau' => 'required|date_format:H:i',
            'thoi_gian_thi' => 'required|integer|min:1',
            'id_phong_thi' => 'required|exists:phong,id',
            'lan_thi' => 'required|integer|in:1,2',
            'trang_thai' => 'required|in:0,1',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $giamThi1 = $this->input('id_giam_thi_1');
            $giamThi2 = $this->input('id_giam_thi_2');

            if ($giamThi1 && $giamThi2 && $giamThi1 == $giamThi2) {
                $validator->errors()->add('id_giam_thi_2', 'Giám thị 2 phải khác giám thị 1.');
            }
        });
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);
        $data['thoi_gian_thi'] = (int) ($data['thoi_gian_thi'] ?? 0);
        return $data;
    }

    
}