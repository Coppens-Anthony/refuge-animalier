<?php

namespace Database\Factories;

use App\Models\Animal;
use App\Models\AnimalVaccine;
use App\Models\Vaccine;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnimalVaccineFactory extends Factory
{
    protected $model = AnimalVaccine::class;

    public function definition(): array
    {
        return [
            'animal_id' => Animal::factory(),
            'vaccine_id' => Vaccine::factory(),
        ];
    }
}
