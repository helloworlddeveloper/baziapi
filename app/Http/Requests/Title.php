<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Title extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'max:15',
        ];
    }

    public function messages()
    {
        return [
            'title.max' => '最多15位',
        ];
    }
}
