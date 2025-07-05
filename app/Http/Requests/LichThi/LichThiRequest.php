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
            'thu' => 'required|integer|in:1,2,3,4,5,6,7',
            'gio_bat_dau' => 'required|date_format:H:i',
            'thoi_gian_thi' => 'required|integer|min:1',
            'id_phong_thi' => 'required|exists:phong,id',
            'lan_thi' => 'required|integer|in:1,2',
            
            
        ];
    }
    public function messages(): array
    {
        return [
            'id_lop_hoc_phan.required' => 'Vui lòng chọn môn thi.',
            'id_lop_hoc_phan.exists' => 'Môn thi không hợp lệ.',

            'id_giam_thi_1.required' => 'Vui lòng chọn giám thị 1.',
            'id_giam_thi_1.exists' => 'Giám thị 1 không hợp lệ.',

            'id_giam_thi_2.exists' => 'Giám thị 2 không hợp lệ.',

            'id_tuan.required' => 'Vui lòng chọn tuần thi.',
            'id_tuan.exists' => 'Tuần thi không hợp lệ.',

            'thu.required' => 'Vui lòng nhập ngày thi.',
            'thu.date_format' => 'Ngày thi không đúng định dạng (Y-m-d).',

            'gio_bat_dau.required' => 'Vui lòng nhập giờ bắt đầu.',
            'gio_bat_dau.date_format' => 'Giờ bắt đầu không đúng định dạng (H:i).',

            'thoi_gian_thi.required' => 'Vui lòng nhập thời gian làm bài.',
            'thoi_gian_thi.integer' => 'Thời gian làm bài phải là một số nguyên.',
            'thoi_gian_thi.min' => 'Thời gian làm bài phải lớn hơn 1 phút.',

            'id_phong_thi.required' => 'Vui lòng chọn phòng thi.',
            'id_phong_thi.exists' => 'Phòng thi không hợp lệ.',

            'lan_thi.required' => 'Vui lòng chọn lần thi.',
            'lan_thi.integer' => 'Lần thi phải là một số nguyên.',
            'lan_thi.in' => 'Lần thi phải là 1 hoặc 2.',
        ];

    }
}