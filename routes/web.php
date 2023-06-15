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


Route::view('teste', 'template_admin.layout');

Auth::routes();

//Route::view('/', 'home')->name('root');

Route::resource('/', TshirtImageController::class);

Route::middleware('auth')->group(function () {
    Route::get('cart/confirmar', [CartController::class, 'confirmar'])->name('cart.confirmar');
    Route::post('cart', [CartController::class, 'store'])->name('cart.store');
});

Route::get('tshirt_images/minhas', [TshirtImageController::class, 'minhasTshirtImages'])
    ->name('tshirt_images.minhas')
    ->middleware('auth');

Route::resource('tshirt_images', TshirtImageController::class);

Route::get('cart', [CartController::class, 'show'])->name('cart.show');

// Remove a item from the cart:
Route::delete('cart', [CartController::class, 'removeFromCart'])->name('cart.remove');

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
