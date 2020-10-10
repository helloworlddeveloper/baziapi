<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopHeadImageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'head_logo' => 'mimes:png|max:100',
        ];
    }

    public function messages()
    {
        return [
            'head_logo.mimes' => '仅支持 png 图片格式',
            'head_logo.max' => '图片最大100kb',
        ];
    }
}
