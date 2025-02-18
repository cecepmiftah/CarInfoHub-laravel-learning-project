<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(SignupController::class)->group(function () {
    Route::get('/signup', 'create')->name('signup');
    Route::post('/signup','store')->name('signup.store');
});

Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('/reset-password', 'create')->name('reset-password');
});

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/car/search', [CarController::class, 'search'])->name('car.search');
Route::get('/car/watchlist', [CarController::class, 'watchlist'])->name('car.watchlist')->middleware('auth');
Route::patch('/car/watchlist/{car}', [CarController::class, 'toggleWatchlist'])->name('car.toggleWatchlist')->middleware('auth');

Route::prefix('/car/images')->group(function () {
    Route::get('/{car}', [CarController::class, 'editImages'])->name('car.editImages');

    Route::patch('/{car}', [CarController::class, 'updateImages'])->name('car.images.update');
});

Route::get('get-models/{maker_id}', [CarController::class, 'getModels']);
Route::get('get-cities/{state_id}', [CarController::class, 'getCities']);
Route::delete('/cars/delete-multiple', [CarController::class, 'destroyMultiple'])->name('car.deleteMultiple');


Route::resource('car', CarController::class)->except('show')->middleware('auth');

Route::get('/car/{car}', [CarController::class, 'show'])->name('car.show');

Route::resource('user', ProfileController::class)->only(['edit', 'update'])->middleware('auth');

Route::patch('/user/update-password/{user}', [ProfileController::class, 'updatePassword'])->name('user.update-password')->middleware('auth');
