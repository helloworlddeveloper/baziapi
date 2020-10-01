<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class RegisterRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => [
                'bail', 'required', 'between:2,24',
                'regex:/^[\x{4e00}-\x{9fa5}_a-zA-Z0-9]+$/u',
                'unique:users'
            ],
            'email' => 'bail|required|email|unique:users',
            'password' => 'bail|required|between:6,30',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => '请输入账号名称',
            'username.between' => '账号名称2-24位',
            'username.regex' => '账号名称只限中英文、数字和下划线 _',
            'username.unique' => '该账号已被注册 请更换',
            'email.required' => '请输入Email',
            'email.email' => '请输入正确的Email格式',
            'email.unique' => '该Email已被注册 请更换',
            'password.required' => '请输入登陆密码',
            'password.between' => '密码位数6-30位',
        ];
    }
}
