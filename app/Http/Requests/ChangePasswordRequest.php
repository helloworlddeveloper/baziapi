<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => 'bail|required|between:6,30',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => '请输入新的登陆密码',
            'password.between' => '密码位数6-30位',
        ];
    }
}
