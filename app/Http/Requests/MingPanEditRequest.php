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
            'call' => 'required|max:30',
            'id' => 'required|exists:ming_pan',

            'year' => 'max:4',
            'month' => 'max:2',
            'day' => 'max:2',
            'hour' => 'max:2',
            'minute' => 'max:2',
            'sex' => 'max:1',
            'name' => 'max:30',
            'born' => 'max:100',
            'area' => 'max:10',
            'type' => 'max:1000',
            'desc' => 'max:1000',
            'baZiTime' => 'max:30',
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
