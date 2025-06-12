<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StudentLoginRequest extends FormRequest
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
            'ma_sv' => 'required',
            'password' => 'required|string|',
        ];
    }

    public function messages()
    {
        return [
            'ma_sv.required' => 'Không được để trống',
            'password.required'  => 'Không được để trống',
        ];
    }
}
