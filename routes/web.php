<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\TransactionDetailsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/category', [CategoriesController::class, 'index'])->name('category');
Route::post('/category', [CategoriesController::class, 'store'])->name('categories.store');
Route::delete('/category/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');

Route::get('/item', [ItemsController::class, 'index'])->name('item');
Route::post('/item', [ItemsController::class, 'store'])->name('items.store');
Route::delete('/item/{id}', [ItemsController::class, 'destroy'])->name('items.destroy');

Route::get('/transaction_detail/{id}', [TransactionDetailsController::class, 'show'])
    ->name('transaction_detail');

Route::get('/transaction', [TransactionsController::class, 'index'])->name('transaction');
Route::get('/transactions/{id}', [TransactionDetailsController::class, 'show']);

Route::get('/selectitem', [ItemsController::class, 'selectitem'])->name('selectitem');
Route::post('/cart/add', [ItemsController::class, 'addToCart'])->name('cart.add');

Route::get('/checkout', [ItemsController::class, 'checkout'])->name('checkout');
Route::delete('/cart/{id}', [ItemsController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/cashier', [CashierController::class, 'index'])->name('cashier');
Route::post('/cashier/pay', [CashierController::class, 'pay'])->name('cashier.pay');
Route::get('/nota/{id}', [CashierController::class, 'nota'])->name('nota');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
