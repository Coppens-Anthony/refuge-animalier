<?php

namespace Database\Factories;

use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AnimalFactory extends Factory
{
    protected $model = Animal::class;

    public function definition(): array
    {
        return [
            'picture' => $this->faker->word(),
            'name' => $this->faker->name(),
            'age' => Carbon::now(),
            'sex' => $this->faker->word(),
            'coat' => $this->faker->word(),
            'temperament' => $this->faker->word(),
            'status' => $this->faker->word(),
            'species_id' => $this->faker->randomNumber(),
            'vaccines_id' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
