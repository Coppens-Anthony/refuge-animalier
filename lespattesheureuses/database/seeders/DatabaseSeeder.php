<?php

namespace Database\Seeders;

use App\Enums\Members;
use App\Models\Animal;
use App\Models\Breed;
use App\Models\Specie;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vaccine;
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


        /* Animals seeding */
        for ($i = 0; $i < 20; $i++) {
            $animal = Animal::factory()->create([
                'breed_id' => $seeding_breeds[array_rand($seeding_breeds)]
            ]);

            $compatibleVaccines = $animal->breed->specie->vaccine;


            $animal->vaccine()->attach(
                $compatibleVaccines
                    ->random(rand(0, $compatibleVaccines->count()))
                    ->pluck('id')
                    ->toArray()
            );
        }


        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => 'password',
            'status' => Members::ADMINISTRATOR,
        ]);

        User::factory(10)->create();
    }
}

