<?php

use App\Http\Controllers\MachineController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider and all of them will | be assigned to the "web" middleware group. Make something great! | */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

# Profile
Route::middleware('auth')->controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::patch('/profile', 'update')->name('profile.update');
    Route::delete('/profile', 'destroy')->name('profile.destroy');
});

# Machines
Route::middleware('auth')->controller(MachineController::class)->group(function () {
    Route::get('/machines', 'index')->name('machines.index');
    Route::post('/machines', 'store')->name('machines.store');
    Route::get('/machines/{machine}', 'edit')->name('machines.edit');
    Route::put('/machines/{machine}', 'update')->name('machines.update');
    // Route::delete('/machines/{machine_id}', 'destroy')->name('machines.destroy');
});

/*
Route::resource('machines', UserController::class)
    ->only(['index', 'store'])
    ->middleware('auth'); */


require __DIR__ . '/auth.php';
