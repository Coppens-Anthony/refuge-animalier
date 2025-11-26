<?php

use Illuminate\Support\Facades\Route;

require 'client.php';

Route::view('login', 'pages.login')
    ->name('login')->middleware('guest');

Route::livewire('dashboard', 'pages::⚡dashboard')
    ->name('dashboard')->middleware('auth');
