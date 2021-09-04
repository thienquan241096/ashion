<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFormRequest extends FormRequest
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
            'name' => [
                'required',
                'min:2', 'max:20'
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->id),
            ],
            'password' => ['min:6'],
            'confirmPassword' => ['same:password'],
            'phone' => [
                'required',
                'min:10',
                'max:11'
            ],
        ];

        if ($this->id == null) {
            $formRules['password'][] = 'required';
            $formRules['confirmPassword'][] = 'required';
        }
        return $formRules;
    }

    public function messages()
    {
        $messages = [
            'name.required' => 'Vui lòng k để trống',
            'name.min' => 'Vui lòng nhập ít nhất 2 kí tự',
            'name.max' => 'Vui lòng nhập dưới 20 kí tự',
            'email.required' => 'Vui lòng k để trống',
            'email.email' => 'Vui lòng nhập đúng định dạng',
            'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Vui lòng k để trống',
            'password.min' => 'Vui lòng nhập ít nhất 6 kí tự',
            'confirmPassword.required' => 'Vui lòng k để trống',
            'confirmPassword.same' => 'mật khẩu nhập lại không khớp',
            'phone.required' => 'Vui lòng k để trống',
            // 'phone.numeric' => 'Vui lòng nhập đúng định dạng',
            'phone.min' => 'Vui lòng nhập ít nhất 10 số',
            'phone.max' => 'Vui lòng nhập dưới 11 số',
        ];

        return $messages;
    }
}
