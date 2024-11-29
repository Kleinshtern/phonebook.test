<?php

use App\Http\Controllers\Phonebook\ContactsController;
use App\Http\Controllers\Phonebook\FavoriteController;
use App\Http\Controllers\Phonebook\FormDataController;
use Illuminate\Support\Facades\Route;

Route::apiResource("contacts", ContactsController::class);

Route::patch('/contacts/{contact}/mark-favorite', [FavoriteController::class, 'markFavorite']);
Route::patch('/contacts/{contact}/unmark-favorite', [FavoriteController::class, 'unmarkFavorite']);

Route::get("/phonebook/type-numbers", [FormDataController::class, 'typeNumbers'])
    ->name("contacts.type-numbers");
