<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransaksiController; // Tambahkan import controller transaksi

// Rute halaman utama
Route::get('/', function () {
    return view('tambah_barang');
});

// Rute untuk melihat barang
Route::get('/lihat-barang', function () {
    return view('tambah_barang'); // Sesuaikan jika diperlukan view yang berbeda
});

// Rute resource untuk brands
Route::resource('/brands', BrandController::class);

// Rute resource untuk categories
Route::resource('/categories', CategoryController::class);

// Rute resource untuk barangs
Route::resource('barangs', BarangController::class);

// Rute resource untuk barang masuk
Route::resource('barang_masuk', BarangMasukController::class);

// Rute resource untuk barang keluar
Route::resource('barangkeluar', BarangKeluarController::class);

// Rute resource untuk transaksi
Route::resource('transaksi', TransaksiController::class); // Tambahkan rute resource untuk transaksi
