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
use App\Http\Controllers\ColorController;


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
Route::get('/', [TshirtImageController::class, 'catalogo'])->name('root');

Route::get('tshirt_images/minhas', [TshirtImageController::class, 'minhasTshirtImages'])->name('tshirt_images.minhas')
    ->middleware('can:viewAny, App\Model\TshirtImage');

Route::get('tshirt_images/minhas/{image_url?}', [TshirtImageController::class, 'getPrivateTshirtImage'])->name('tshirt_images.minha')
    ->middleware('can:viewAny, App\Model\TshirtImage');

Route::get('/catalogo', [TshirtImageController::class, 'catalogo'])->name('tshirt_images.catalogo');

Route::get('catalogo/tshirt_image/{tshirt_image}', [TshirtImageController::class, 'showProduto'])->name('tshirt_images.produto');

Route::resource('tshirt_images', TshirtImageController::class);


///Orders
Route::get('encomendas', [OrderController::class, 'minhasEncomendas'])->name('orders.minhas')
    ->middleware('can:viewEncomendas, App\Model\Order');

Route::get('orders/fatura/{receipt_url?}', [OrderController::class, 'getFatura'])->name('orders.fatura')    //dont work
    ->middleware('can:viewAny, App\Model\Order');


Route::resource('orders', OrderController::class)
    ->only(['index'])
    ->middleware('can:viewAny, App\Models\Order');

Route::resource('orders', OrderController::class)
    ->only(['show'])
    ->middleware('can:view, order');

Route::resource('orders', OrderController::class)
    ->only(['create', 'store'])
    ->middleware('can:create, App\Models\Order');

Route::resource('orders', OrderController::class)
    ->only(['update', 'edit'])
    ->middleware('can:update, order');

Route::resource('orders', OrderController::class)
    ->only(['destroy'])
    ->middleware('can:delete, order');


//Prices
Route::resource('prices', PriceController::class)
    ->only(['index']);

Route::resource('prices', PriceController::class)
    ->only(['update', 'edit'])
    ->middleware('can:update,price');


///Colors
Route::resource('colors', ColorController::class)
    ->only(['index', 'show']);

Route::resource('colors', ColorController::class)
    ->only(['update', 'edit'])
    ->middleware('can:update,color');

Route::resource('colors', ColorController::class)
    ->only(['destroy'])
    ->middleware('can:delete,color');


///Cart
Route::get('cart', [CartController::class, 'show'])->name('cart.show');

Route::get('cart/confirmar', [CartController::class, 'confirmar'])->name('cart.confirmar')
    ->middleware('auth');

Route::post('cart/{tshirt_image}', [CartController::class, 'addToCart'])->name('cart.add');

Route::delete('cart', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::post('cart/edit', [CartController::class, 'editCartItem'])->name('cart.editCartItem');

Route::put('cart/{tshirt_image}', [CartController::class, 'updateCartItem'])->name('cart.update');

Route::put('cart', [CartController::class, 'updateItemQty'])->name('cart.updateItemQuantity');

Route::post('cart', [CartController::class, 'store'])->name('cart.store');


///Dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index')
    ->middleware('can:viewAny, App\Models\User');


///Users
Route::delete('users/{user}/foto', [UserController::class, 'destroy_foto'])->name('users.foto.destroy') //dont work
    ->middleware('can:delete, user');

Route::resource('users', UserController::class)
    ->only(['index'])
    ->middleware('can:viewAny,App\Models\User');

Route::resource('users', UserController::class)
    ->only(['show'])
    ->middleware('can:view,user');

Route::resource('users', UserController::class)
    ->only(['create', 'store']);

Route::resource('users', UserController::class)
    ->only(['update', 'edit'])
    ->middleware('can:update,user');

Route::resource('users', UserController::class)
    ->only(['destroy'])
    ->middleware('can:delete,user');


///Customers
Route::delete('customers/{customer}/foto', [CustomerController::class, 'destroy_foto'])->name('customers.foto.destroy') //dont work
    ->middleware('can:delete, customer');

Route::resource('customers', CustomerController::class)
    ->only(['index'])
    ->middleware('can:viewAny,App\Models\Customer');

Route::resource('customers', CustomerController::class)
    ->only(['show'])
    ->middleware('can:view,customer');

Route::resource('customers', CustomerController::class)
    ->only(['create', 'store']);

Route::resource('customers', CustomerController::class)
    ->only(['update', 'edit'])
    ->middleware('can:update,customer');

Route::resource('customers', CustomerController::class)
    ->only(['destroy'])
    ->middleware('can:delete,customer');


///Password
Route::get('/password/change', [ChangePasswordController::class, 'show'])
    ->name('password.change.show');

Route::post('/password/change', [ChangePasswordController::class, 'store'])
    ->name('password.change.store');

