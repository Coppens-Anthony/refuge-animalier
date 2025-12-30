<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'telephone' => 'regex:/^0[1-9](?:[\s\.]?[0-9]{2}){4}$/|required',
            'subject' => 'required|in:question,renseignement,volunteer',
            'message' => 'required|max:255'
        ]);

        Mail::to(config('mail.from.address'))->queue(
            new ContactForm($validated)
        );

        return view('client.contact');
    }
}
