<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\BrandController;

Route::get('/', function () {
    return view('tambah_barang');
});


Route::get('/lihat-barang', function () {
    return view('tambah_barang');
});

Route::resource('/brands', \App\Http\Controllers\BrandController::class);

Route::resource('/categories', \App\Http\Controllers\CategoryController::class);
