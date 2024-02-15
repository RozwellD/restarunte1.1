<?php

namespace Database\Factories;

use App\Models\Puesto;
use App\Models\UserLaboral;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserLaboralFactory extends Factory
{
    protected $model = UserLaboral::class;

    public function definition()
    {
        return [
            'puesto_id' => '',
            'nss' => fake()->numerify("###########"),
            'rfc' => fake()->regexify(config('constants.regex.rfc')),
            'salario_diario' => 248.93 * 100,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

