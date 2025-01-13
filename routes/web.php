<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [ProductController::class,'index'])->name("home");

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/showprod', [ProductController::class, 'index'])->name('products.index');
    Route::get('/nouveau', [ProductController::class, 'create'])->name('products.create');
    Route::post('/creation', [ProductController::class, 'store'])->name('products.store');
    Route::get('/edition/{id}', [ProductController::class, 'edit'])->name("products.edit");
    Route::put('/edit/{id}', [ProductController::class, 'update']);
    Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});


require __DIR__ . '/auth.php';
