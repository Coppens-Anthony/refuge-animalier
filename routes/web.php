<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

require 'client.php';

Route::domain('admin.refuge-animalier-backup-moddrt.laravel.cloud')->group(function () {

    Route::view('/', 'pages.login.login')
        ->name('login')->middleware('guest');

    Route::livewire('/dashboard', 'pages::dashboard.⚡dashboard')
        ->name('dashboard')->middleware('auth');

    Route::livewire('/animals', 'pages::animals.⚡index')
        ->name('index.animals')->middleware('auth');
    Route::livewire('/animals/create', 'pages::animals.⚡create')
        ->name('create.animals')->middleware('auth');
    Route::livewire('/animals/{animal}', 'pages::animals.⚡show')
        ->name('show.animals')->middleware('auth');
    Route::livewire('/animals/{animal}/edit', 'pages::animals.⚡edit')
        ->name('edit.animals')->middleware('auth');

    Route::livewire('/adoptions', 'pages::adoptions.⚡index')
        ->name('index.adoptions')->middleware('auth');
    Route::livewire('/adoptions/{adoption}', 'pages::adoptions.⚡show')
        ->name('show.adoptions')->middleware('auth');

    Route::livewire('/validations', 'pages::validations.⚡index')
        ->name('index.validations')->middleware('auth');

    Route::livewire('/messages', 'pages::messages.⚡index')
        ->name('index.messages')->middleware('auth');

    Route::livewire('/members', 'pages::members.⚡index')
        ->name('index.members')->middleware('auth');
    Route::livewire('/members/create', 'pages::members.⚡create')
        ->name('create.members')->middleware('auth')->can('create', User::class);
    Route::livewire('/members/{member}', 'pages::members.⚡show')
        ->name('show.members')->middleware('auth');
    Route::livewire('/members/{member}/edit', 'pages::members.⚡edit')
        ->name('edit.members')->middleware('auth')/*->can('edit', 'member')*/;

    Route::livewire('/database', 'pages::database.⚡index')
        ->name('index.database')->middleware('auth');
});

