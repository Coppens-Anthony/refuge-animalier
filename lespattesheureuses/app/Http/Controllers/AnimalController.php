<?php

namespace App\Http\Controllers;

use App\Models\Animal;

class AnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::all();

        return view('pages.animals.⚡index', compact('animals'));
    }
}
