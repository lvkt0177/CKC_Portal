<?php

namespace App\Http\Requests\BienBan;

use Illuminate\Foundation\Http\FormRequest;

class BienBanRequest extends FormRequest
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
            'id_sv' => 'required|integer',
            'id_tuan' => 'required|integer',
            'tieu_de' => 'required|string|max:255',
            'noi_dung'=> 'required|string',
            'thoi_gian_bat_dau' => 'required',
            'thoi_gian_ket_thuc' => 'required',
            'so_luong_sinh_vien' => 'required|integer',
            'vang_mat' => 'required|integer',
            'sinh_vien_vang' => 'array',
            'trang_thai' => 'nullable|integer'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $soLuong = $this->input('so_luong_sinh_vien');
            $vangMat = $this->input('vang_mat');

            $thoiGianBatDau = $this->input('thoi_gian_bat_dau');
            $thoiGianKetThuc = $this->input('thoi_gian_ket_thuc');

            if ($thoiGianBatDau > $thoiGianKetThuc) {
                $validator->errors()->add('thoi_gian_bat_dau', 'Thời gian không hợp lệ');
                $validator->errors()->add('thoi_gian_ket_thuc', 'Thời gian không hợp lệ');
            }

            if ($vangMat > $soLuong) {
                $validator->errors()->add('vang_mat', 'Số sinh viên vắng mặt không được lớn hơn tổng số sinh viên.');
            }
        });
    }
}
