<?php

namespace Database\Seeders;

use App\Enums\Adoptions;
use App\Enums\Members;
use App\Models\Adopter;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Breed;
use App\Models\Coat;
use App\Models\Specie;
use App\Models\User;
use App\Models\Vaccine;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $species = [
            'Chien' => [
                'Husky',
                'Berger allemand',
                'Cocker'
            ],
            'Chat' => [
                'Main Coon',
                'Persan',
                'Siamois',
            ],
        ];

        $species_vaccines = [
            'Chien' => [
                'DHPP',
                'Rage',
                'Parvovirose',
                'Piroplasmose',
            ],
            'Chat' => [
                'Typhus',
                'Coryza',
                'Leucose féline',
                'Rage',
            ],
        ];

        $coatNames = [
            'Blanc',
            'Beige',
            'Gris',
            'Noir',
            'Feu',
            'Roux',
            'Tricolore',
            'Tâcheté',
            'Tigré',
        ];

        $coats = collect();
        foreach ($coatNames as $coatName) {
            $coats->push(Coat::create([
                'name' => $coatName,
            ]));
        }

        $seeding_breeds = [];
        foreach ($species as $specie => $breeds) {

            $specie = Specie::create(['name' => $specie]);

            foreach ($breeds as $breed) {
                $breed = Breed::create([
                    'name' => $breed,
                    'specie_id' => $specie->id
                ]);

                $seeding_breeds[] = $breed->id;
            }
        }

        $seedingVaccines = [];
        foreach ($species_vaccines as $species_vaccine => $vaccines) {
            $specie = Specie::where('name', '=', $species_vaccine)->first();

            foreach ($vaccines as $vaccine) {
                $vaccine = Vaccine::create([
                    'name' => $vaccine,
                    'specie_id' => $specie->id,
                ]);
            }
        }


        $animals = collect();
        for ($i = 0; $i < 20; $i++) {
            $animal = Animal::factory()->create([
                'breed_id' => $seeding_breeds[array_rand($seeding_breeds)]
            ]);

            $animal->coat()->attach(
                $coats->random(rand(1, 2))->pluck('id')->toArray()
            );

            $compatibleVaccines = $animal->breed->specie->vaccine;

            $animal->vaccine()->attach(
                $compatibleVaccines
                    ->random(rand(0, $compatibleVaccines->count()))
                    ->pluck('id')
                    ->toArray()
            );

            $animals->push($animal);
        }

        $adopters = Adopter::factory(20)->create();

        for ($i = 0; $i < 20; $i++) {
            $status = collect([
                Adoptions::FINISHED,
                Adoptions::PENDING,
                Adoptions::IN_PROGRESS,
            ])->random();

            Adoption::factory()->create([
                'status' => $status,
                'date' => ($status == Adoptions::FINISHED ? Carbon::now() : null),
                'animal_id' => $animals->unique()->random()->id,
                'adopter_id' => $adopters->random()->id,
            ]);
        }

        User::factory()->create([
            'lastname' => 'Doe',
            'firstname' => 'John',
            'email' => 'john@doe.com',
            'telephone' => '0456.95.34.65',
            'password' => 'password',
            'status' => Members::ADMINISTRATOR,
        ]);

        User::factory(10)->create();
    }
}

