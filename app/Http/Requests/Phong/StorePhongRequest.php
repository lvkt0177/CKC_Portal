<?php

namespace App\Http\Requests\Phong;

use Illuminate\Foundation\Http\FormRequest;

class StorePhongRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return checkPermissions(Acl()::PERMISSION_ROOM_CREATE);
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
            'ten' => 'required|string|unique:phong,ten,null,id|max:100',
            'so_luong' => 'required|integer|min:1',
            'loai_phong' => 'required|integer|in:0,1,2', 
        ];
    }

    /**
     * Get the custom messages for the validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'ten.required' => 'Tên phòng không được để trống',
            'ten.unique' => 'Tên phòng này đã tồn tại. Vui lòng lấy tên khác',
            'ten.max' => 'Tên phòng khóa 100 ký tự',
            'so_luong.integer' => 'Số lượng phòng phái là số nguyên',
            'so_luong.required' => 'Số lượng phòng không được để trống',
            'so_luong.min' => 'Số lượng phòng phái lớn hơn 0',
            'loai_phong.required' => 'Loại phòng không được để trống',
        ];
    }

}
