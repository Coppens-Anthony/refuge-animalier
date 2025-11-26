<?php

use Illuminate\Support\Facades\Route;

require 'client.php';

Route::domain('admin.lespattesheureuses.test')->group(function () {

    Route::view('/', 'pages.login.login')
        ->name('login')->middleware('guest');

    Route::livewire('/dashboard', 'pages::dashboard.⚡dashboard')
        ->name('dashboard')->middleware('auth');

    Route::livewire('/animals', 'pages::animals.⚡index')
        ->name('index.animals')->middleware('auth');

});

