<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $formRules = [
            'cate_name' => [
                'required',
                Rule::unique('category')->ignore($this->id),
                'min:2', 'max:30'
            ],
            'image' => ['mimes:jpg,bmp,png'],
        ];

        if ($this->id == null) {
            $formRules['image'][] = 'required';
        }
        return $formRules;
    }

    public function messages()
    {
        $messages = [
            'cate_name.required' => 'Vui lòng k để trống',
            'cate_name.unique' => 'Tên đã tồn tại',
            'cate_name.min' => 'Vui lòng nhập ít nhất 2 kí tự',
            'image.required' => 'Vui lòng k để trống',
            'image.mimes' => 'Vui lòng nhập đúng định dạng',
        ];
        return $messages;
    }
}