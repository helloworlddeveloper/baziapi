<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MingPanEditRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'call' => 'required',
            'id' => 'required|exists:ming_pan',
        ];
    }

    public function messages()
    {
        return [
            'call.required' => '最少填写一个命主称呼',
            'id.exists' => '数据不存在，非法操作',
            'id.required' => '数据不存在',
        ];
    }
}
