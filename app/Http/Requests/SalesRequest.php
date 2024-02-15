<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'table' => ['required'],
            'attendant_id' => ['required'],
            'platillos_id' => ['required'],
            'tip' => ['required', 'integer'],
            'date' => ['required'],
            'branch_id' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
