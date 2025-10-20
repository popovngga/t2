<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'showHomePage'])->name('home');

    Route::group(['prefix' => 'actors'], function () {
        Route::get('/', [ActorController::class, 'index'])->name('actors.index');
        Route::post('/', [ActorController::class, 'store'])->name('actors.store');
    });
});
