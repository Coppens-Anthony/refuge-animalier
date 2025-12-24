<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Animal;

class AnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::where('status', Status::ADOPTABLE)->get();

        return view('client.animals.animals', compact('animals'));
    }

    public function show(Animal $animal)
    {
        $suggestedAnimals = Animal::where('status', Status::ADOPTABLE)
            ->where('id', '!=', $animal->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('client.animals.animal', compact('animal','suggestedAnimals'));
    }
}
