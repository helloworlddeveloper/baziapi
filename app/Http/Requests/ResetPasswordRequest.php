<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => 'bail|required|between:6,30',
            'resetPassword' => 'bail|required|between:6,30',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => '原密码不能为空',
            'password.between' => '密码位数6-30位',
            'resetPassword.required' => '请输入新的登陆密码',
            'resetPassword.between' => '密码位数6-30位',
        ];
    }
}
