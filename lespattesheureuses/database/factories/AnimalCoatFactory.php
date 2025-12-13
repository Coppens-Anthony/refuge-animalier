<?php

namespace Database\Factories;

use App\Models\Animal;
use App\Models\AnimalCoat;
use App\Models\Coat;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnimalCoatFactory extends Factory
{
    protected $model = AnimalCoat::class;
    public function definition(): array
    {
        return [
            'animal_id' => Animal::factory(),
            'coat_id' => Coat::factory(),
        ];
    }
}
