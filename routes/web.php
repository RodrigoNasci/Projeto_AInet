<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TshirtImageController;

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

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
