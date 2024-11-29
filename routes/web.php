<?php

use Illuminate\Support\Facades\Route;

include __DIR__ . "/auth.php";

Route::get("{any}", function () {
    return view('app');
})->where("any", ".*");
