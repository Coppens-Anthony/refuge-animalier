<?php

use App\Enums\Adoptions;
use App\Enums\Status;
use App\Models\Adopter;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Breed;
use App\Models\Specie;

it('shows all animals with an adoptable status', function () {
    $specie = Specie::factory()->create();
    $breed = Breed::factory()->for($specie)->create();
    Animal::factory()->for($breed)->count(5)->create(['status' => Status::ADOPTABLE]);
    Animal::factory()->for($breed)->count(5)->create(['status' => Status::UNAVAILABLE]);

    $response = $this->get(route('client_animals'));

    $response->assertViewHas('animals', function ($animals) {
        return $animals->count() === 5
            && $animals->every(fn($animal) => $animal->status === Status::ADOPTABLE);
    });
});



