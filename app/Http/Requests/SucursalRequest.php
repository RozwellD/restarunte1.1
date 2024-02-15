<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SucursalRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'email', 'max:190'],
            'active' => ['boolean'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
