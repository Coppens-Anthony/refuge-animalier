<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Animal;
use App\Models\Breed;
use App\Models\Coat;
use App\Models\Specie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $query = Animal::where('status', Status::ADOPTABLE);

        $query->when($request->input('search'), function ($q, $search) {
            $q->where('name', 'like', '%' . $search . '%');
        });

        $query->when($request->input('specie'), function ($q, $specie) {
            $q->whereHas('breed', function ($breedQuery) use ($specie) {
                $breedQuery->where('specie_id', $specie);
            });
        });

        $query->when($request->input('breed'), function ($q, $breed) {
            $q->where('breed_id', $breed);
        });

        $query->when($request->input('sexe'), function ($q, $sex) {
            $q->where('sex', $sex);
        });

        $query->when($request->input('coat'), function ($q, $coat) {
            $q->where('coat_id', $coat);
        });

        $query->when($request->input('age'), function ($q, $age) {
            switch ($age) {
                case '0_1':
                    $q->whereBetween('birthdate', [
                        Carbon::now()->subYear(),
                        Carbon::now()
                    ]);
                    break;
                case '1_3':
                    $q->whereBetween('birthdate', [
                        Carbon::now()->subYears(3),
                        Carbon::now()->subYear(),
                    ]);
                    break;
                case '3_6':
                    $q->whereBetween('birthdate', [
                        Carbon::now()->subYears(6),
                        Carbon::now()->subYears(3),
                    ]);
                    break;
                case '6_10':
                    $q->whereBetween('birthdate', [
                        Carbon::now()->subYears(10),
                        Carbon::now()->subYears(6),
                    ]);
                    break;
                case 'more_10':
                    $q->where('birthdate', '<', Carbon::now()->subYears(10));;
                    break;
            }
        });

        $animals = $query->paginate(9);

        $species = Specie::all()->map(fn($specie) => [
            'value' => $specie->id,
            'trad' => $specie->name,
        ])->toArray();

        $breeds = Breed::all()->map(fn($breed) => [
            'value' => $breed->id,
            'trad' => $breed->name,
        ])->toArray();

        $coats = Coat::all()->map(fn($coat) => [
            'value' => $coat->id,
            'trad' => $coat->name,
        ])->toArray();

        return view('client.animals.animals', compact('animals', 'species', 'breeds', 'coats'));
    }

    public function show(Animal $animal)
    {
        $suggestedAnimals = Animal::where('status', Status::ADOPTABLE)
            ->where('id', '!=', $animal->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('client.animals.animal', compact('animal', 'suggestedAnimals'));
    }
}
