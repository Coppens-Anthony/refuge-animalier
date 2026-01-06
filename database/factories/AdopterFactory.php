<?php

namespace Database\Factories;

use App\Models\Adopter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AdopterFactory extends Factory
{
    protected $model = Adopter::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            //'telephone' => $this->faker->phoneNumber(),
            'telephone' => $this->faker->regexify('0[1-9][0-9]{8}'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
