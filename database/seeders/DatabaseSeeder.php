<?php

namespace Database\Seeders;

use App\Enums\Adoptions;
use App\Enums\Members;
use App\Enums\Sex;
use App\Enums\Status;
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
use Illuminate\Support\Facades\Hash;

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

        foreach ($species_vaccines as $species_vaccine => $vaccines) {
            $specie = Specie::where('name', '=', $species_vaccine)->first();

            foreach ($vaccines as $vaccine) {
                Vaccine::create([
                    'name' => $vaccine,
                    'specie_id' => $specie->id,
                ]);
            }
        }

        $animalNames = [
            'Max', 'Bella', 'Charlie', 'Luna', 'Cooper', 'Daisy', 'Milo', 'Lucy',
            'Rocky', 'Molly', 'Buddy', 'Sadie', 'Jack', 'Sucre', 'Duke', 'Bailey',
            'Oliver', 'Billy', 'Bear', 'Maggie', 'Moka', 'Milou', 'Bill', 'Larry', 'Chelsea',
            'Roucky', 'Ragnar', 'Beethoven', 'Baghera', 'Ivar'
        ];

        $temperaments = [
            'Aime beaucoup le contact humain et recherche constamment les câlins. Très doux et patient avec les enfants.',
            'Déborde d\'énergie et adore jouer pendant des heures. A besoin de beaucoup d\'exercice quotidien.',
            'Calme et posé, apprécie les longues siestes et les moments de tranquillité. Idéal pour une vie en appartement.',
            'Très sociable avec les autres animaux et les humains. S\'adapte facilement aux nouvelles situations.',
            'Indépendant mais affectueux. Aime avoir son espace personnel mais vient chercher des caresses régulièrement.',
            'Un peu timide au début mais devient très attachant une fois en confiance. Demande de la patience.',
            'Protecteur envers sa famille et son territoire. Bon gardien qui aboie pour alerter.',
            'Extrêmement curieux et intelligent. Aime explorer et découvrir de nouvelles choses chaque jour.',
            'Doux et obéissant, parfait pour une première adoption. S\'entend bien avec tout le monde.',
            'Joueur et affectueux, adore les jeux interactifs et les moments de complicité avec son maître.',
            'Calme avec les adultes mais très joueur avec les enfants. Équilibre parfait pour une famille.',
            'Énergique le matin mais se calme en soirée. Apprécie les routines et les habitudes stables.',
            'Très affectueux et pot de colle. Ne supporte pas la solitude et préfère être toujours accompagné.',
            'Indépendant et aventurier. Aime sortir explorer mais revient toujours pour les câlins du soir.',
            'Sociable et doux, parfait pour une maison avec plusieurs animaux. S\'entend avec chats et chiens.',
            'Calme et contemplatif. Passe des heures à observer par la fenêtre. Très zen et apaisant.',
            'Joueur infatigable qui adore les jouets et les activités stimulantes. Besoin de beaucoup d\'attention.',
            'Affectueux mais respecte les limites. Sait quand venir chercher des câlins et quand rester tranquille.',
            'Protecteur mais jamais agressif. Excellent avec les enfants qu\'il surveille avec bienveillance.',
            'Curieux et intelligent, apprend vite les tours et adore les défis mentaux. Très réceptif au dressage.'
        ];

        $sexes = Sex::values();
        $status = Status::values();

        $animals = collect();
        for ($i = 0; $i < 30; $i++) {
            $animal = Animal::create([
                'avatar' => '',
                'name' => $animalNames[$i],
                'birthdate' => Carbon::now()->subYears(rand(0, 20))->subDays(rand(0, 365)),
                'sex' => $sexes[array_rand($sexes)],
                'temperament' => $temperaments[array_rand($temperaments)],
                'status' => $status[array_rand($status)],
                'breed_id' => $seeding_breeds[array_rand($seeding_breeds)],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $animal->coat()->attach(
                $coats->random(rand(1, 2))->pluck('id')->toArray()
            );

            $compatibleVaccines = $animal->breed->specie->vaccine;
            if ($compatibleVaccines->count() > 0) {
                $animal->vaccine()->attach(
                    $compatibleVaccines
                        ->random(rand(0, $compatibleVaccines->count()))
                        ->pluck('id')
                        ->toArray()
                );
            }

            $animals->push($animal);
        }

        $adopterData = [
            ['name' => 'Pierre Dupont', 'email' => 'pierre.dupont@example.com', 'telephone' => '0471.23.45.67'],
            ['name' => 'Marie Martin', 'email' => 'marie.martin@example.com', 'telephone' => '0472.34.56.78'],
            ['name' => 'Jean Bernard', 'email' => 'jean.bernard@example.com', 'telephone' => '0473.45.67.89'],
            ['name' => 'Sophie Dubois', 'email' => 'sophie.dubois@example.com', 'telephone' => '0474.56.78.90'],
            ['name' => 'Luc Lambert', 'email' => 'luc.lambert@example.com', 'telephone' => '0475.67.89.01'],
            ['name' => 'Claire Moreau', 'email' => 'claire.moreau@example.com', 'telephone' => '0476.78.90.12'],
            ['name' => 'Thomas Simon', 'email' => 'thomas.simon@example.com', 'telephone' => '0477.89.01.23'],
            ['name' => 'Julie Laurent', 'email' => 'julie.laurent@example.com', 'telephone' => '0478.90.12.34'],
            ['name' => 'Marc Lefebvre', 'email' => 'marc.lefebvre@example.com', 'telephone' => '0479.01.23.45'],
            ['name' => 'Emma Leroy', 'email' => 'emma.leroy@example.com', 'telephone' => '0470.12.34.56'],
            ['name' => 'Antoine Roux', 'email' => 'antoine.roux@example.com', 'telephone' => '0471.23.45.67'],
            ['name' => 'Laura David', 'email' => 'laura.david@example.com', 'telephone' => '0472.34.56.78'],
        ];

        $adopters = collect();
        foreach ($adopterData as $data) {
            $adopters->push(Adopter::create($data));
        }

        $adoptionStatuses = [
            Adoptions::FINISHED,
            Adoptions::PENDING,
            Adoptions::IN_PROGRESS,
        ];

        $messages = [
            'Je suis très intéressé par cet animal.',
            'Nous avons un grand jardin et beaucoup d\'amour à donner.',
            'Mon fils rêve d\'avoir un animal de compagnie.',
            'Nous cherchons un compagnon pour notre famille.',
            'J\'ai beaucoup d\'expérience avec les animaux.',
            'Nous pouvons offrir un foyer aimant et stable.',
            'Je travaille à domicile, donc je serai toujours présent.',
            'Nous avons déjà adopté et nous sommes ravis.',
            'Notre animal précédent nous manque énormément.',
            'Nous sommes prêts à accueillir un nouveau membre.',
        ];

        for ($i = 0; $i < 10; $i++) {
            $status = $adoptionStatuses[array_rand($adoptionStatuses)];

            Adoption::create([
                'status' => $status,
                'date' => ($status == Adoptions::FINISHED ? Carbon::now()->subDays(rand(1, 30)) : null),
                'message' => $messages[array_rand($messages)],
                'animal_id' => $animals->unique()->random()->id,
                'adopter_id' => $adopters->random()->id,
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now(),
            ]);
        }

        $userData = [
            ['lastname' => 'Doe', 'firstname' => 'Élise', 'email' => 'elise@doe.com', 'telephone' => '0456.95.34.65', 'status' => Members::ADMINISTRATOR],
            ['lastname' => 'Smith', 'firstname' => 'Thomas', 'email' => 'thomas@smith.com', 'telephone' => '0471.12.34.56', 'status' => Members::VOLUNTEER],
            ['lastname' => 'Johnson', 'firstname' => 'Bob', 'email' => 'bob@johnson.com', 'telephone' => '0472.23.45.67', 'status' => Members::VOLUNTEER],
            ['lastname' => 'Williams', 'firstname' => 'Carol', 'email' => 'carol@williams.com', 'telephone' => '0473.34.56.78', 'status' => Members::VOLUNTEER],
            ['lastname' => 'Brown', 'firstname' => 'David', 'email' => 'david@brown.com', 'telephone' => '0474.45.67.89', 'status' => Members::VOLUNTEER],
            ['lastname' => 'Jones', 'firstname' => 'Emily', 'email' => 'emily@jones.com', 'telephone' => '0475.56.78.90', 'status' => Members::VOLUNTEER],
            ['lastname' => 'Garcia', 'firstname' => 'Frank', 'email' => 'frank@garcia.com', 'telephone' => '0476.67.89.01', 'status' => Members::VOLUNTEER],
            ['lastname' => 'Miller', 'firstname' => 'Grace', 'email' => 'grace@miller.com', 'telephone' => '0477.78.90.12', 'status' => Members::VOLUNTEER],
            ['lastname' => 'Davis', 'firstname' => 'Henry', 'email' => 'henry@davis.com', 'telephone' => '0478.89.01.23', 'status' => Members::VOLUNTEER],
            ['lastname' => 'Rodriguez', 'firstname' => 'Iris', 'email' => 'iris@rodriguez.com', 'telephone' => '0479.90.12.34', 'status' => Members::VOLUNTEER],
            ['lastname' => 'Martinez', 'firstname' => 'Jack', 'email' => 'jack@martinez.com', 'telephone' => '0470.01.23.45', 'status' => Members::VOLUNTEER],
        ];

        foreach ($userData as $data) {
            User::create([
                'avatar' => null,
                'lastname' => $data['lastname'],
                'firstname' => $data['firstname'],
                'email' => $data['email'],
                'telephone' => $data['telephone'],
                'password' => Hash::make('password'),
                'status' => $data['status'],
                'availabilities' => [
                    'monday' => ['morning' => (bool)rand(0, 1), 'afternoon' => (bool)rand(0, 1), 'evening' => (bool)rand(0, 1)],
                    'tuesday' => ['morning' => (bool)rand(0, 1), 'afternoon' => (bool)rand(0, 1), 'evening' => (bool)rand(0, 1)],
                    'wednesday' => ['morning' => (bool)rand(0, 1), 'afternoon' => (bool)rand(0, 1), 'evening' => (bool)rand(0, 1)],
                    'thursday' => ['morning' => (bool)rand(0, 1), 'afternoon' => (bool)rand(0, 1), 'evening' => (bool)rand(0, 1)],
                    'friday' => ['morning' => (bool)rand(0, 1), 'afternoon' => (bool)rand(0, 1), 'evening' => (bool)rand(0, 1)],
                    'saturday' => ['morning' => (bool)rand(0, 1), 'afternoon' => (bool)rand(0, 1), 'evening' => (bool)rand(0, 1)],
                    'sunday' => ['morning' => (bool)rand(0, 1), 'afternoon' => (bool)rand(0, 1), 'evening' => (bool)rand(0, 1)],
                ],
            ]);
        }
    }
}
