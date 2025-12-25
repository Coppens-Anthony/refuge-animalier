<?php

namespace App\Http\Controllers;
use App\Enums\Adoptions;
use App\Enums\Status;
use App\Models\Adoption;
use App\Models\Animal;

class HomeController
{
    public function index()
    {
        $animals = Animal::all();
        $adoptions = Adoption::where('status', Adoptions::FINISHED);
        $animalsAdoptable = $animals->where('status', Status::ADOPTABLE);

        $lastAnimals = Animal::where('status', Status::ADOPTABLE)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('client.home', compact('animals', 'adoptions', 'animalsAdoptable', 'lastAnimals'));
    }
}
