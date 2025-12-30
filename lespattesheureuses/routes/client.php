<?php

use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;

Route::domain('lespattesheureuses.test')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('client_home');

    Route::get('animals', [AnimalController::class, 'index'])->name('client_animals');

    Route::get('animals/{animal}', [AnimalController::class, 'show'])->name('client_animal');

    Route::get('animals/{animal}/request', [AdoptionController::class, 'create'])->name('client_animal_request');
    Route::post('animals/{animal}/request', [AdoptionController::class, 'store'])->name('client_animal_request.store');

    Route::get('team', [MemberController::class, 'index'])->name('client_team');


    Route::get('contact', function () {
        return view('client.contact');
    })->name('client_contact');
    Route::post('contact', [ContactController::class, 'store'])->name('client_contact.store');
});
