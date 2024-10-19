<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\BrandController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('tambah_barang');
});


Route::get('/lihat-barang', function () {
    return view('tambah_barang');
});

Route::resource('/brands', \App\Http\Controllers\BrandController::class);

Route::get('/', [DashboardController::class, 'home']);
Route::get('tentang', [DashboardController::class, 'tentang']);
Route::get('kontak', [DashboardController::class, 'kontak']);