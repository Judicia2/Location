<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoitureController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\ReservationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/ajout', [VoitureController::class,'create'])->name('create');
Route::get('/show', [VoitureController::class, 'show'])->name('show');
Route::put('/put/{id}', [VoitureController::class, 'update']) ->name('update');
Route::delete('/del/{id}', [VoitureController::class, 'destroy'])->name('destroy');

// Route for the client crud

Route::post('/ajoute', [ClientController::class,'create'])->name('create');
Route::get('/shows', [ClientController::class, 'show'])->name('show');
Route::put('/pute/{id}', [ClientController::class, 'update']) ->name('update');
Route::delete('/dele/{id}', [ClientController::class, 'destroy'])->name('destroy');

// Route for the Model


Route::post('/ajouter', [ModelController::class,'create'])->name('create');
Route::get('/showse', [ModelController::class, 'show'])->name('show');
Route::put('/putes/{id}', [ModelController::class, 'update']) ->name('update');
Route::delete('/delet/{id}', [ModelController::class, 'destroy'])->name('destroy');


// Route for Reservation


Route::post('/ajoutes', [ReservationController::class,'create'])->name('create');
Route::get('/showses', [ReservationController::class, 'show'])->name('show');
Route::put('/edit/{id}', [ReservationController::class, 'update']) ->name('update');
Route::delete('/delete/{id}', [ReservationController::class, 'destroy'])->name('destroy');