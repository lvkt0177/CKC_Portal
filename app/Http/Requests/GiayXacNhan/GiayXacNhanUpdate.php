<?php

namespace App\Http\Requests\GiayXacNhan;

use Illuminate\Foundation\Http\FormRequest;

class GiayXacNhanUpdate extends FormRequest
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
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:dang_ky_giay,id',
            'id_giang_vien' => 'required|integer|exists:users,id',
            'trang_thai' => 'nullable|integer|in:1,2', 
        ];
    }
}
