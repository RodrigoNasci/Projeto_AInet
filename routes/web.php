<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TshirtImageController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tshirt_images', TshirtImageController::class);

Route::get('cart', [CartController::class, 'show'])->name('cart.show');

Route::post('cart/{tshirt_image}', [CartController::class, 'addToCart'])->name('cart.add');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
