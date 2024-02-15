<?php

namespace Database\Factories;

use App\Models\Platillo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PlatilloFactory extends Factory
{
    protected $model = Platillo::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'elaboration_duration' => $this->faker->word(),
            'procution_cost' => $this->faker->randomNumber(),
            'sale_price' => $this->faker->randomNumber(),
            'branch_id' => $this->faker->words(),
        ];
    }
}
