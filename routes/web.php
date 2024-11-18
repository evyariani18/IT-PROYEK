<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\KatalogController;

// Route untuk menampilkan form login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');

// Route untuk menangani login
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Route untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route resource untuk katalog
Route::resource('katalog', KatalogController::class);

// Route untuk halaman tentang
Route::get('/tentang', function () {
    return view('katalog.tentang');
})->name('tentang');





