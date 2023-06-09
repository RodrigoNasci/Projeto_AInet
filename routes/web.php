<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TshirtImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

//Route::view('/', 'home')->name('root');

Route::resource('/', TshirtImageController::class);

Route::resource('tshirt_images', TshirtImageController::class);

Route::get('cart', [CartController::class, 'show'])->name('cart.show');

Route::post('cart/{tshirt_image}', [CartController::class, 'addToCart'])->name('cart.add');

Route::resource('users', UserController::class);
Route::delete('users/{user}/foto', [UserController::class, 'destroy_foto'])->name('users.foto.destroy');

Route::resource('customers', CustomerController::class);
Route::delete('customers/{customer}/foto', [CustomerController::class, 'destroy_foto'])->name('customers.foto.destroy');

Route::get('/password/change', [ChangePasswordController::class, 'show'])
    ->name('password.change.show');

Route::post('/password/change', [ChangePasswordController::class, 'store'])
    ->name('password.change.store');


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
