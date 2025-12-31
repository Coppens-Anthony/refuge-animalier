<?php

namespace Database\Factories;

use App\Models\Adoption;
use App\Models\AdoptionNote;
use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdoptionNoteFactory extends Factory
{
    protected $model = AdoptionNote::class;

    public function definition(): array
    {
        return [

            'adoption_id' => Adoption::factory(),
            'note_id' => Note::factory(),
        ];
    }
}
