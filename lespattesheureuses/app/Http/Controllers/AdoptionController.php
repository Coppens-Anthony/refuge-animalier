<?php

namespace App\Http\Controllers;

use App\Enums\Adoptions;
use App\Enums\Status;
use App\Models\Adopter;
use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    public function create(Animal $animal)
    {
        $animal->load(['breed', 'coat', 'vaccine']);
        return view('client.animals.request', compact('animal'));
    }

    public function store(Request $request, Animal $animal)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'telephone' => 'required|regex:/^0[1-9](?:[\s\.]?[0-9]{2}){4}$/',
            'message' => 'required|max:255'
        ]);

        $adopter = Adopter::where('email', $validated['email'])->first();

        if (!$adopter) {
            $adopter = Adopter::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'telephone' => $validated['telephone'],
            ]);
        }

        Adoption::create([
            'animal_id' => $animal->id,
            'adopter_id' => $adopter->id,
            'status' => Adoptions::PENDING,
            'message' => $validated['message'],
            'date' => null
        ]);

        $animal->update([
            'status' => Status::PENDING,
        ]);

        return redirect(route('client_animals'));
    }


}
