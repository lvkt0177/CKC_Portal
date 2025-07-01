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
            "tuan"=> "numeric|required",
            "hoc_ky"=> "numeric|required",
            //
        ];
    }
    public function messages(): array
    {
        return [
            "tuan.required"=> "Tuần phải tồn tại",
            "hoc_ky.required"=> "Học kỳ phải tồn tại",
        ];
    }
}