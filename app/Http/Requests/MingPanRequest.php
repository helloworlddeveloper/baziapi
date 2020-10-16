<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MingPanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'call' => 'required',
            'id' => 'required|exists:users'
        ];
    }

    public function messages()
    {
        return [
            'call.required' => '最少填写一个命主称呼',
            'id.exists' => '用户不存在，非法操作',
            'id.required' => '用户不存在',
        ];
    }
}
