<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\GdriveController;

// Route untuk login dan logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route resource untuk katalog
Route::resource('katalog', KatalogController::class);

Route::get('/tentang', function () {
    return view('katalog.tentang');
})->name('tentang');

Route::get('/produk', function () {
    return view('katalog.produk');
})->name('produk');

Route::get('/alamat', function () {
    return view('katalog.alamat');
})->name('alamat');


Route::get('/kontak', function () {
    return view('katalog.kontak');
})->name('kontak');

Route::get('/upload', [GdriveController::class, 'upload']);
Route::post('/upload', [GdriveController::class, 'upload'])->name('upload');

