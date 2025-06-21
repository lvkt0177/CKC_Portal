<?php

namespace App\Http\Requests\PhieuLenLop;

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
            'tuan_id' => 'required|exists:tuan,id',
            'mon_hoc' => 'required|array|min:1',
            'mon_hoc.*.tiet_bat_dau' => 'required|integer',
            'mon_hoc.*.so_tiet' => 'required|integer',
            'mon_hoc.*.thu' => 'required|integer|min:2|max:7',
            'mon_hoc.*.id_phong' => 'required|exists:phong,id',
        ];
    }
    public function messages(): array
    {
        return [

        'mon_hoc.*.tiet_bat_dau.required' => 'Chưa chọn tiết bắt đầu.',
        'mon_hoc.*.tiet_bat_dau.integer' => 'Tiết bắt đầu phải là số.',

        'mon_hoc.*.so_tiet.required' => 'Chưa chọn số tiết.',
        'mon_hoc.*.so_tiet.integer' => 'Số tiết phải là số.',

        'mon_hoc.*.thu.required' => 'Chưa chọn thứ trong tuần.',
        'mon_hoc.*.thu.integer' => 'Thứ trong tuần phải là số.',
        'mon_hoc.*.thu.min' => 'Thứ trong tuần không hợp lệ.',
        'mon_hoc.*.thu.max' => 'Thứ trong tuần không hợp lệ.',

        'mon_hoc.*.id_phong.required' => 'Chưa chọn phòng học.',
        'mon_hoc.*.id_phong.exists' => 'Phòng học không hợp lệ.',
        ];
    }
}