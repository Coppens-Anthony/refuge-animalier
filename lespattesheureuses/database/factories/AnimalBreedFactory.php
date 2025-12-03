<?php

namespace Database\Factories;

use App\Models\Animal;
use App\Models\AnimalBreed;
use App\Models\Breed;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnimalBreedFactory extends Factory
{
    protected $model = AnimalBreed::class;

    public function definition(): array
    {
        return [

            'animal_id' => Animal::factory(),
            'breed_id' => Breed::factory(),
        ];
    }
}
