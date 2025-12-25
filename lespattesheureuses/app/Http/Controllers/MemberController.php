<?php

namespace App\Http\Controllers;

use App\Enums\Adoptions;
use App\Enums\Status;
use App\Models\Adopter;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::all();

        return view('client.team', compact('members'));
    }
}
