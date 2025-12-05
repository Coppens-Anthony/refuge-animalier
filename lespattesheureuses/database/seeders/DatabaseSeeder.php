<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Breed;
use App\Models\Specie;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        $seedingBreeds = [];
        foreach ($species as $specie => $breeds) {

            $specie = Specie::create(['name' => $specie]);

            foreach ($breeds as $breed) {
                $breed = Breed::create([
                    'name' => $breed,
                    'specie_id' => $specie->id
                ]);

                $seedingBreeds[] = $breed->id;
            }
        }


        /* Animals seeding */
        for ($i = 0; $i < 20; $i++) {
            Animal::factory()->create([
                'breed_id' => $seedingBreeds[array_rand($seedingBreeds)]
            ]);
        }

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'john@doe.com',
        ]);
    }
}

