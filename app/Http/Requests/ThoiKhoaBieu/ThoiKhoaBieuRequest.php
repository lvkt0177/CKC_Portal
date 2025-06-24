<?php

namespace App\Http\Requests\ThoiKhoaBieu;

use Illuminate\Foundation\Http\FormRequest;

class ThoiKhoaBieuRequest extends FormRequest
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
            'hoc_ky' => 'required|exists:hoc_ky,id',
            'lop_id'=> 'required|exists:lop,id',
            'mon_hoc' => 'required|exists:mon_hoc,id',
            'tiet_bat_dau' => 'required|integer',
            'so_tiet' => 'required|integer',
            'id_phong' => 'required|exists:phong,id',
            'id_tuan' => 'required|exists:tuan,id',
            'thu' => 'required|integer|min:2|max:7',
        ];
    }
    public function messages(): array
    {
        return [
            'hoc_ky.required'=> 'Học kỳ được tạo sẵn',
            'hoc_ky.exists'=> 'Học kỳ phải tồn tại',
            'lop_id'=> 'Lớp phải tồn tại',
            'id_tuan.required'=> 'Tuần được tạo sẵn',
            'tiet_bat_dau.required' => 'Chưa chọn tiết bắt đầu.',
            'tiet_bat_dau.integer' => 'Tiết bắt đầu phải là số.',

            'so_tiet.required' => 'Chưa chọn số tiết.',
            'so_tiet.integer' => 'Số tiết phải là số.',

            'thu.required' => 'Chưa chọn thứ trong tuần.',
            'thu.integer' => 'Thứ trong tuần phải là số.',
            'thu.min' => 'Thứ trong tuần không hợp lệ.',
            'thu.max' => 'Thứ trong tuần không hợp lệ.',

            'id_phong.required' => 'Chưa chọn phòng học.',
            'id_phong.exists' => 'Phòng học không hợp lệ.',
        ];
    }
}