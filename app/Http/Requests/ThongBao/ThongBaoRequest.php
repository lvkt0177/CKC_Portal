<?php

namespace App\Http\Requests\ThongBao;

use Illuminate\Foundation\Http\FormRequest;

class ThongBaoRequest extends FormRequest
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
            'tieu_de' => 'required|string|max:255',
            'noi_dung'=> 'required|string',
            'tu_ai' => 'required|string',
            'ngay_gui'  => 'required|date|date_format:Y-m-d\TH:i|before_or_equal:'.now()->format('Y-m-d\TH:i'),
            'files.*' => 'mimes:doc,docx,xls,xlsx,pdf|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'tieu_de.required'   => 'Tiêu đề không được để trống.',
            'tieu_de.string'     => 'Tiêu đề phải là một chuỗi.',
            'tieu_de.max'        => 'Tiêu đề không được vượt quá 255 ký tự.',

            'noi_dung.required'  => 'Nội dung không được để trống.',
            'noi_dung.string'    => 'Nội dung phải là một chuỗi.',

            'tu_ai.required'     => 'Người gửi (từ AI) không được để trống.',
            'tu_ai.string'       => 'Người gửi phải là một chuỗi.',

            'ngay_gui.required'  => 'Ngày gửi không được để trống.',
            'ngay_gui.date'      => 'Ngày gửi không đúng định dạng ngày.',

            'files.*.mimes'      => 'Tệp đính kèm chỉ cho phép các định dạng: doc, docx, xls, xlsx, pdf.',
            'files.*.max'        => 'Mỗi tệp đính kèm không được vượt quá 10MB.',
        ];
    }

}
