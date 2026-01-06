<?php

use App\Models\Adopter;
use App\Models\Animal;
use App\Models\Breed;
use App\Models\Specie;
use function Pest\Laravel\assertDatabaseCount;

it('allows a user to make an adoption\'s request for an animal in the client\'s part and redirects to animals\' page', function () {
    $specie = Specie::factory()->create();
    $breed = Breed::factory()->for($specie)->create();
    $animal = Animal::factory()->for($breed)->create();
    $adopter = Adopter::factory()->create();

    $adoptionData = [
      'name' => $adopter->name,
      'email' => $adopter->email,
      'telephone' => $adopter->telephone,
      'message' => 'test',
    ];

    $response = $this->post(route('client_animal_request.store', $animal), $adoptionData);

    $response->assertRedirect(route('client_animals'));
    assertDatabaseCount('adoptions', 1);
});

