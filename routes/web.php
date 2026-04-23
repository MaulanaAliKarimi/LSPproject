<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/category', function () {
    return view('category');
})->name('category');

Route::get('/item', function () {
    return view('item');
})->name('item');

Route::get('/transaction_detail', function () {
    return view('transaction_detail');
})->name('transaction_detail');

Route::get('/transaction', function () {
    return view('transaction');
})->name('transaction');

Route::get('/selectitem', function () {
    return view('selectitem');
})->name('selectitem');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/cashier', function () {
    return view('cashier');
})->name('cashier');

Route::get('/nota', function () {
    return view('nota');
})->name('nota');

Route::get('/history', function () {
    return view('history');
})->name('history');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
