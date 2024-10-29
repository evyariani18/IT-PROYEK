<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;

Route::get('/', function () {
    return view('tambah_barang');
});


Route::get('/lihat-barang', function () {
    return view('tambah_barang');
});

Route::resource('/brands', \App\Http\Controllers\BrandController::class);

Route::resource('/categories', \App\Http\Controllers\CategoryController::class);

Route::resource('/barangs', \App\Http\Controllers\BarangController::class);

Route::resource('/barang_masuk', \App\Http\Controllers\BarangMasukController::class);
