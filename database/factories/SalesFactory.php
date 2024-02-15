<?php

namespace Database\Factories;

use App\Models\Sales;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SalesFactory extends Factory
{
    protected $model = Sales::class;

    public function definition(): array
    {
        return [
            'table' => $this->faker->word(),
            'attendant_id' => $this->faker->words(),
            'platillos_id' => $this->faker->word(),
            'tip' => $this->faker->randomDigit() ,
            'date' => $this->faker->word(),
            'branch_id' => $this->faker->word(),
        ];
    }
}
