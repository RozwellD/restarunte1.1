<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PuestoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'active' => ['boolean'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
