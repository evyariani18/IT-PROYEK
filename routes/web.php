<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransaksiController; // Import TransaksiController
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController; // Import LoginController
use App\Http\Controllers\Dashboard2Controller; // Import Dashboard2Controller untuk dashboard tambahan

// Rute halaman utama
Route::get('/', function () {
    return view('tambah_barang');
});

// Rute untuk melihat barang
Route::get('/lihat-barang', function () {
    return view('tambah_barang'); // Sesuaikan jika diperlukan view yang berbeda
});

// Rute untuk halaman dashboard utama
Route::get('/dashboard', [DashboardController::class, 'home'])->name('dashboard');

// Rute untuk halaman dashboard tambahan
Route::get('/dashboard2', [Dashboard2Controller::class, 'home'])->name('dashboard2.home');

// Rute resource untuk brands
Route::resource('brands', BrandController::class);

// Rute resource untuk categories
Route::resource('categories', CategoryController::class);

// Rute resource untuk barangs
Route::resource('barangs', BarangController::class);

// Rute resource untuk barang masuk
Route::resource('barang_masuk', BarangMasukController::class);

// Rute resource untuk transaksi
Route::resource('transaksi', TransaksiController::class); // Rute resource untuk transaksi

// Rute untuk login dan user
Route::resource('users', UserController::class);
