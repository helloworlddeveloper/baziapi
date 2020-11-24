<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserMessageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'message_content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'message_content.required' => '留言内容不能是空的',
        ];
    }
}
