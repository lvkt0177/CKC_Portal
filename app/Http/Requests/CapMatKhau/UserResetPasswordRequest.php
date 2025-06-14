<?php

namespace App\Http\Requests\CapMatKhau;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use App\Models\YeuCauCapLaiMatKhau;
use App\Models\SinhVien;
use App\Enum\LoaiTaiKhoan;

class UserResetPasswordRequest extends FormRequest
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
            'email' => 'required|email|exists:ho_so,email',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'Email không được để trống.',
            'email.exists' => 'Email không tồn tại. Vui lòng kiểm tra lại',
        ];
    }
}