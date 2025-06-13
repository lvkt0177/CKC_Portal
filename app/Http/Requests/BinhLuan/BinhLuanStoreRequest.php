<?php

namespace App\Http\Requests\BinhLuan;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\BinhLuan;
use App\Rules\BinhLuanRules;

class BinhLuanStoreRequest extends FormRequest
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
        return BinhLuanRules::rules();
    }

    public function messages()
    {
        return BinhLuanRules::messages();
    }

}
