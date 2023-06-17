<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\MachineProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider and all of them will | be assigned to the "web" middleware group. Make something great! | */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', ['markers' => LocationController::getMarkers()]);
})->middleware(['auth', 'verified'])->name('dashboard');

# Profile
Route::middleware('auth')->controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::patch('/profile', 'update')->name('profile.update');
    Route::delete('/profile', 'destroy')->name('profile.destroy');
});

# Products
Route::resource('products', ProductController::class)->middleware(['auth', 'verified']);

# Cards
Route::resource('cards', CardController::class)->middleware(['auth', 'verified']);

# Ajax calls for products in machines (must be placed before resource
Route::post('machines/addProduct', [MachineController::class, 'addProduct'])->name('machines.addProduct');
Route::patch('machines/updateProduct', [MachineController::class, 'updateProduct'])->name('machines.updateProduct');
Route::delete('machines/deleteProduct', [MachineController::class, 'deleteProduct'])->name('machines.deleteProduct');

# Machines
Route::resource('machines', MachineController::class)->middleware(['auth', 'verified']);

# Locations
Route::resource('locations', LocationController::class)->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';
