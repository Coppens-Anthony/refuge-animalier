<?php

namespace Database\Factories;

use App\Enums\Adoptions;
use App\Models\Adopter;
use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AdoptionFactory extends Factory
{
    protected $model = Adoption::class;

    public function definition(): array
    {
        return [
            'date' => null,
            'status' => $this->faker->randomElement(Adoptions::values()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'animal_id' => Animal::factory(),
            'adopter_id' => Adopter::factory(),
        ];
    }
}
