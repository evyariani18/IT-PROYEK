<?php

use App\Http\Controllers\LoginController;

// Route untuk menampilkan form login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');

// Route untuk menangani login
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Route untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
