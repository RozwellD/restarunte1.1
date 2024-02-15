<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlatilloRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'description' => ['required'],
            'elaboration_duration' => ['required', 'integer'],
            'production_cost' => ['required', 'integer'],
            'sale_price' => ['required', 'integer'],
            'branch_id' => ['required'],
            'active' => ['required', 'boolean']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
