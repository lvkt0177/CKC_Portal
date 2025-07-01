<?php

namespace App\Http\Requests\BinhLuan;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\BinhLuan;

class BinhLuanStoreRequestAPI extends FormRequest
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
            'noi_dung' => 'required|string|max:1000',
            'id_binh_luan_cha' => 'nullable|integer|exists:binh_luan,id',
        ];
    }
}
