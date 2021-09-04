<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'product_name' => [
                'required', 'min:3', 'max:40'
            ],
            'brand' => [
                'required', 'min:3', 'max:40'
            ],
            'price' => ['required'],
            'sale' => ['required'],
            'size' => ['required'],
            'color' => ['required'],
            'image' => [
                'mimes:jpg,bmp,png'
            ],
            'description' => ['required'],
            // 'highlight' => 'required',
        ];
        if ($this->id == null) {
            $formRules['image'][] = 'required';
        }
        return $formRules;
    }
    public function messages()
    {
        $messages = [
            'product_name.required' => 'Vui lòng k để trống',
            'product_name.min' => 'Vui lòng nhập ít nhất 3 kí tự',
            'product_name.max' => 'Vui lòng nhập dưới 40 kí tự',
            'brand.required' => 'Vui lòng k để trống',
            'brand.min' => 'Vui lòng nhập ít nhất 3 kí tự',
            'brand.max' => 'Vui lòng nhập dưới 40 kí tự',
            'price.required' => 'Vui lòng k để trống',
            'size.required' => 'Vui lòng k để trống',
            'color.required' => 'Vui lòng k để trống',
            'image.required' => 'Vui lòng k để trống',
            'image.mimes' => 'Vui lòng nhập đúng định dạng ảnh',
            'description.required' => 'Vui lòng k để trống',
        ];

        return $messages;
    }
}