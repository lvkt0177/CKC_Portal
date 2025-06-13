<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherLoginRequest extends FormRequest
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
            'tai_khoan' => 'required',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages()
    {
        return [
            'tai_khoan.required' => 'Không được để trống.',
            'password.required'  => 'Không được để trống',
            'password.min'       => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ];
    }
}
