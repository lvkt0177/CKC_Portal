<?php

namespace App\Http\Requests\CapMatKhau;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use App\Models\YeuCauCapLaiMatKhau;
use App\Models\SinhVien;
use App\Enum\LoaiTaiKhoan;

class SinhVienYeuCauRequest extends FormRequest
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
            'ma_sv' => 'required|exists:sinhvien,ma_sv',
            'loai' => 'required|integer|in:0,1',
        ];
    }
    public function messages(): array
    {
        return [
            'ma_sv.required' => 'Mã số sinh viên không được để trống',
            'ma_sv.exists' => 'Mã số sinh viên không tồn tại. Vui lòng kiểm tra lại',
            'loai.required' => 'Loại tài khoản không được để trống',    
            'loai.integer' => 'Loại tài khoản không được để trống',    
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $ma_sv = $this->input('ma_sv');
            $loai = $this->input('loai');

            $sinhVien = SinhVien::where('ma_sv', $ma_sv)->first();

            if ($sinhVien) {
                $daGui = YeuCauCapLaiMatKhau::where('id_sinh_vien', $sinhVien->id)
                            ->where('loai', $loai)
                            ->exists();

                if ($daGui) {
                    $tenLoai = LoaiTaiKhoan::from($loai)->getLabel();
                    $validator->errors()->add('ma_sv', " ");
                    $validator->errors()->add('loai', "Bạn đã gửi yêu cầu cấp lại mật khẩu cho loại tài khoản {$tenLoai}. Vui lòng chờ xử lý.");
                }
            }
        });
    }

}