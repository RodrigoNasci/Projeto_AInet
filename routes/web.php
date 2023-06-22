<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TshirtImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PriceController;


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


Route::view('home', 'home');

Auth::routes();

///Tshirts
Route::resource('tshirt_images', TshirtImageController::class);

Route::get('/', [TshirtImageController::class, 'catalogo'])->name('root');

Route::get('cart/confirmar', [CartController::class, 'confirmar'])->name('cart.confirmar');
Route::post('cart', [CartController::class, 'store'])->name('cart.store');


Route::get('tshirt_images/minhas', [TshirtImageController::class, 'minhasTshirtImages'])->name('tshirt_images.minhas');

Route::get('tshirt_images/minhas/{image_url?}', [TshirtImageController::class, 'getPrivateTshirtImage'])->name('tshirt_images.minha');

Route::get('/catalogo', [TshirtImageController::class, 'catalogo'])->name('tshirt_images.catalogo');

Route::get('catalogo/tshirt_image/{tshirt_image}', [TshirtImageController::class, 'showProduto'])->name('tshirt_images.produto');


///Orders
Route::get('orders/fatura/{receipt_url?}', [OrderController::class, 'getFatura'])->name('orders.fatura');

Route::resource('orders', OrderController::class);

Route::get('encomendas', [OrderController::class, 'minhasEncomendas'])->name('orders.minhas');


//Prices
Route::resource('prices', PriceController::class);


///Cart
Route::get('cart', [CartController::class, 'show'])->name('cart.show');

Route::get('cart/confirmar', [CartController::class, 'confirmar'])->name('cart.confirmar');

Route::post('cart/{tshirt_image}', [CartController::class, 'addToCart'])->name('cart.add');

Route::delete('cart', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::post('cart/edit', [CartController::class, 'editCartItem'])->name('cart.editCartItem');

Route::put('cart/{tshirt_image}', [CartController::class, 'updateCartItem'])->name('cart.update');

Route::put('cart', [CartController::class, 'updateItemQty'])->name('cart.updateItemQuantity');

Route::post('cart', [CartController::class, 'store'])->name('cart.store');


///Dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


///Users
Route::resource('users', UserController::class);
Route::delete('users/{user}/foto', [UserController::class, 'destroy_foto'])->name('users.foto.destroy');


///Customers
Route::resource('customers', CustomerController::class)
    ->only(['index'])
    ->middleware('can:viewAny,App\Models\Customer');

Route::resource('customers', CustomerController::class)
    ->only(['show'])
    ->middleware('can:view,customer');

Route::resource('customers', CustomerController::class)
    ->only(['update'])
    ->middleware('can:update,customer');

Route::resource('customers', CustomerController::class)
    ->only(['destroy'])
    ->middleware('can:delete,customer');

Route::resource('customers', CustomerController::class)
    ->only(['store']);

Route::delete('customers/{customer}/foto', [CustomerController::class, 'destroy_foto'])->name('customers.foto.destroy')
    ->middleware('can:delete, customer');


///Password
Route::get('/password/change', [ChangePasswordController::class, 'show'])
    ->name('password.change.show');

Route::post('/password/change', [ChangePasswordController::class, 'store'])
    ->name('password.change.store');

