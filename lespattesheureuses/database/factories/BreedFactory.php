<?php

namespace Database\Factories;

use App\Models\Breed;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BreedFactory extends Factory
{
    protected $model = Breed::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'species_id' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
