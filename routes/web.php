<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', [ProductController::class, 'index']);

Route::get('/keranjang', [CartController::class, 'index'])
    ->name('keranjang.index');

Route::post('/keranjang/tambah/{id}', [CartController::class, 'tambah'])
    ->name('keranjang.tambah');

Route::post('/keranjang/tambah-jumlah/{id}', [CartController::class, 'tambahJumlah'])
    ->name('keranjang.tambahJumlah');

Route::post('/keranjang/kurang/{id}', [CartController::class, 'kurangJumlah'])
    ->name('keranjang.kurang');

Route::post('/keranjang/hapus/{id}', [CartController::class, 'hapus'])
    ->name('keranjang.hapus');

Route::post('/keranjang/kosongkan', [CartController::class, 'kosongkan'])
    ->name('keranjang.kosongkan');
