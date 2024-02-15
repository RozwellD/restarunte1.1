<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLaboralRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_id' => ['required'],
            'puesto_id' => ['required'],
            'nss' => ['required', 'integer'],
            'rfc' => ['required'],
            'salario_diario' => ['required', 'integer'],
            'sucursal_id' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
