<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\VoitureController;
use App\Http\Controllers\Controller;

Route::get('/', function () {
    return view('welcome');
});
Route::post ('/ajout', [VoitureController::class, 'create'])->name('create');
