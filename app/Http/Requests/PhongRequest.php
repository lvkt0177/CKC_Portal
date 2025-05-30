<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhongRequest extends FormRequest
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
            //
            'ten' => 'required|string|max:100',
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
            'ten.required' => 'Tên phòng Không được để trống',
            'so_luong.required' => 'Số lượng phòng không được để trống',
        ];
    }
}
