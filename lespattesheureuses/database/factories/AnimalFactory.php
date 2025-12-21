<?php

namespace Database\Factories;

use App\Enums\Sex;
use App\Enums\Status;
use App\Models\Animal;
use App\Models\Breed;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AnimalFactory extends Factory
{
    protected $model = Animal::class;

    public function definition(): array
    {
        return [
            'avatar' => 'max.jpg',
            'name' => $this->faker->name(),
            'birthdate' => Carbon::yesterday(),
            'sex' => $this->faker->randomElement(Sex::values()),
            'temperament' => $this->faker->word(),
            'status' => $this->faker->randomElement(Status::values()),
            'breed_id' => Breed::factory(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
