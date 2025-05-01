<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CharacterController;

Route::get('/', function () {
    return redirect()->route('movies.index');
});

Route::middleware('auth')->group(function () {
    Route::resource('movies', MovieController::class);
    Route::resource('characters', CharacterController::class);
    Route::get('/movies/filter/{type}', [MovieController::class, 'filter'])->name('movies.filter');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
