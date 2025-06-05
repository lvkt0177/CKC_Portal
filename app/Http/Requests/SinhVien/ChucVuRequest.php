<?php

namespace App\Http\Requests\SinhVien;

use Illuminate\Foundation\Http\FormRequest;

class ChucVuRequest extends FormRequest
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
            'chuc_vu' => 'required|integer|in:0,1',
        ];
    }
}
