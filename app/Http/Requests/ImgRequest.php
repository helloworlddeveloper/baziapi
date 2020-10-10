<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImgRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'avatar' => 'mimes:jpeg,png|max:100',
        ];
    }

    public function messages()
    {
        return [
            'avatar.mimes' => '仅支持jpeg jpg png 图片格式',
            'avatar.max' => '图片最大100kb',
        ];
    }
}
