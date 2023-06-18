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

Route::view('home', 'home');

Auth::routes();

//Route::view('/', 'home')->name('root');

//Route::resource('/', TshirtImageController::class);

Route::get('/', [TshirtImageController::class, 'catalogo'])->name('root');

Route::middleware('auth')->group(function () {
    Route::get('cart/confirmar', [CartController::class, 'confirmar'])->name('cart.confirmar');
    Route::post('cart', [CartController::class, 'store'])->name('cart.store');
});

Route::get('tshirt_images/minhas', [TshirtImageController::class, 'minhasTshirtImages'])
    ->name('tshirt_images.minhas')
    ->middleware('auth');

// Rota para mostrar o catálogo de imagens
Route::get('/catalogo', [TshirtImageController::class, 'catalogo'])->name('tshirt_images.catalogo');

// Rota para mostrar cada preview de imagem e opção para adicionar ao carrinho
Route::get('catalogo/tshirt_image/{tshirt_image}', [TshirtImageController::class, 'showProduto'])->name('tshirt_images.produto');

Route::resource('tshirt_images', TshirtImageController::class);

// Rota para mostrar o pdf relativo a uma encomenda (fatura)
route::get('orders/fatura/{receipt_url?}', [OrderController::class, 'getFatura'])->name('orders.fatura');

Route::resource('orders', OrderController::class);


// Vai para a página de edição do item do carrinho de compras
//Route::get('cart/edit', [CartController::class, 'editCartItem'])->name('cart.editCartItem');
// POST para esconder o url
Route::post('cart/edit', [CartController::class, 'editCartItem'])->name('cart.editCartItem');

// Adiciona um item ao carrinho de compras
Route::post('cart/{tshirt_image}', [CartController::class, 'addToCart'])->name('cart.add');

// Remove um item do carrinho de compras
Route::delete('cart', [CartController::class, 'removeFromCart'])->name('cart.remove');

// Mostrar o carrinho de compras
Route::get('cart', [CartController::class, 'show'])->name('cart.show');

// Atualiza a quantidade de um item do carrinho de compras
Route::put('cart', [CartController::class, 'updateItemQty'])->name('cart.updateItemQuantity');

// Atualiza um item do carrinho de compras
Route::put('cart/{tshirt_image}', [CartController::class, 'updateCartItem'])->name('cart.update');

Route::get('cart/confirmar', [CartController::class, 'confirmar'])->name('cart.confirmar');

Route::post('cart', [CartController::class, 'store'])->name('cart.store');

Route::get('encomendas', [OrderController::class, 'minhasEncomendas'])->name('orders.minhas');






Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::resource('users', UserController::class);
Route::delete('users/{user}/foto', [UserController::class, 'destroy_foto'])->name('users.foto.destroy');

Route::resource('customers', CustomerController::class);
Route::delete('customers/{customer}/foto', [CustomerController::class, 'destroy_foto'])->name('customers.foto.destroy');

Route::get('/password/change', [ChangePasswordController::class, 'show'])
    ->name('password.change.show');

Route::post('/password/change', [ChangePasswordController::class, 'store'])
    ->name('password.change.store');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
