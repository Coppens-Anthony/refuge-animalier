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
    Route::livewire('/animals/{animal}', 'pages::animals.⚡show')
        ->name('show.animals')->middleware('auth');
    Route::livewire('/animals/create', 'pages::animals.⚡create')
        ->name('create.animals')->middleware('auth');

    Route::livewire('/requests', 'pages::requests.⚡index')
        ->name('index.requests')->middleware('auth');

    Route::livewire('/validations', 'pages::validations.⚡index')
        ->name('index.validations')->middleware('auth');

    Route::livewire('/messages', 'pages::messages.⚡index')
        ->name('index.messages')->middleware('auth');

    Route::livewire('/members', 'pages::members.⚡index')
        ->name('index.members')->middleware('auth');
    Route::livewire('/members/create', 'pages::members.⚡create')
        ->name('create.members')->middleware('auth');
    Route::livewire('/members/{member}', 'pages::members.⚡show')
        ->name('show.member')->middleware('auth');

    Route::livewire('/profile', 'pages::profile.⚡show')
        ->name('show.profile')->middleware('auth');

});

