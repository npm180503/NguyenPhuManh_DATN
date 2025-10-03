<?php

namespace App\Http\Requests\New;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewsRequest extends FormRequest
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
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'thumb'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'  => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'   => 'Vui lòng nhập tiêu đề',
            'content.required' => 'Vui lòng nhập nội dung',
            'thumb.image'      => 'File tải lên phải là ảnh',
            'status.required'  => 'Vui lòng chọn trạng thái',
        ];
    }
}
