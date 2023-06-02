<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TshirtImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\ChangePasswordController;

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

Route::resource('users', UserController::class);

Route::resource('customers', CustomerController::class);

Route::get('/password/change', [ChangePasswordController::class, 'show'])
    ->name('password.change.show');

Route::post('/password/change', [ChangePasswordController::class, 'store'])
    ->name('password.change.store');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
