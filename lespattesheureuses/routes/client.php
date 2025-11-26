<?php

Route::domain('lespattesheureuses.test')->group(function () {
    Route::get('/', function () {
        return view('client.home');
    })->name('client_home');

    Route::get('animals', function () {
        return view('client/animals.animals');
    })->name('client_animals');

    Route::get('animals/animal', function () {
        return view('client/animals.animal');
    })->name('client_animal');

    Route::get('animals/animal/request', function () {
        return view('client/animals.request');
    })->name('client_animal_request');

    Route::get('team', function () {
        return view('client.team');
    })->name('client_team');

    Route::get('contact', function () {
        return view('client.contact');
    })->name('client_contact');
});
