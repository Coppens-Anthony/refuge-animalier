<?php

use App\Enums\Adoptions;
use App\Enums\Status;
use App\Models\Adopter;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Breed;
use App\Models\Specie;

it('counts the animals with an adoptable status on the home page', function () {
    $specie = Specie::factory()->create();
    $breed = Breed::factory()->for($specie)->create();
    Animal::factory()->for($breed)->count(5)->create(['status' => Status::ADOPTABLE]);

    $response = $this->get(route('client_home'));

    $response->assertViewHas('animalsAdoptable', 5);
});

it('counts the animals in the refuge on the home page', function () {
    $specie = Specie::factory()->create();
    $breed = Breed::factory()->for($specie)->create();
    Animal::factory()->for($breed)->count(50)->create();

    $response = $this->get(route('client_home'));

    $response->assertViewHas('animals', 50);
});

it('counts the adoptions on the home page', function () {
    $specie = Specie::factory()->create();
    $breed = Breed::factory()->for($specie)->create();
    $animals = Animal::factory()->for($breed)->count(20)->create();
    $adopters = Adopter::factory()->count(15)->create();

    foreach (range(0, 14) as $i) {
        Adoption::factory()->for($animals[$i])->for($adopters[rand(0, 14)])->create(['status' => Adoptions::FINISHED]);
    }
    foreach (range(15, 19) as $i) {
        Adoption::factory()->for($animals[$i])->for($adopters[rand(0, 14)])->create(['status' => Adoptions::IN_PROGRESS]);
    }

    $response = $this->get(route('client_home'));

    $response->assertViewHas('adoptions', 15);
});

it('shows the 3 lasts animals with an adoptable status', function () {
    $specie = Specie::factory()->create();
    $breed = Breed::factory()->for($specie)->create();
    Animal::factory()->for($breed)->count(6)->create(['status' => Status::ADOPTABLE]);

    $response = $this->get(route('client_home'));

    $response->assertViewHas('lastAnimals', function ($animals) {
        return $animals->count() <= 3
            && $animals->every(fn($animal) => $animal->status === Status::ADOPTABLE);
    });
});

