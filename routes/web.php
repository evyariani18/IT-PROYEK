<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\GoogleDriveController;
use App\Http\Controllers\TransaksiController; // Import TransaksiController
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController; // Import LoginController
use App\Http\Controllers\Dashboard2Controller; // Import Dashboard2Controller untuk dashboard tambahan
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\DetailPembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\LaporanPembelianController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\Auth\SocialiteController;

// Rute resource untuk brands
Route::resource('brands', BrandController::class);

// Rute resource untuk categories
Route::resource('categories', CategoryController::class);

// Rute resource untuk barangs
Route::resource('barang', BarangController::class);

// Rute resource untuk barang masuk
Route::resource('barang_masuk', BarangMasukController::class);

// Rute resource untuk transaksi
Route::resource('transaksi', TransaksiController::class); // Rute resource untuk transaksi

// Rute untuk login dan user
Route::resource('users', UserController::class);

//Rute untuk pembelian
Route::resource('pembelian', PembelianController::class);

Route::resource('penjualan', PenjualanController::class);

Route::resource('laporan_pembelian', LaporanPembelianController::class)->except(['show']);
Route::get('/laporan_pembelian/cetak_pdf', [LaporanPembelianController::class, 'cetak_pdf'])->name('laporan_pembelian.pembelian_pdf');

Route::resource('laporan_penjualan', LaporanPenjualanController::class)->except(['show']);
Route::get('/laporan_penjualan/cetak_pdf', [LaporanPenjualanController::class, 'cetak_pdf'])->name('laporan_penjualan.penjualan_pdf');

Route::resource('pembelian', PembelianController::class)->except(['show']);
Route::get('/cetak_pembelian/cetak_pdf', [PembelianController::class, 'cetak_pdf'])->name('pembelian.cetak_pembelian');

Route::resource('penjualan', PenjualanController::class)->except(['show']);
Route::get('/cetak_penjualan/cetak_pdf', [PenjualanController::class, 'cetak_pdf'])->name('penjualan.cetak_penjualan');

// Route untuk menampilkan form login (GET)
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.form');

// Route untuk memproses login (POST)
Route::post('/login', [UserController::class, 'login'])->name('login');

// Route untuk menampilkan form registrasi
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register.form');

// Route untuk memproses registrasi
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::resource('dashboards', DashboardController::class);

Route::get('dashboard', [BrandController::class, 'dashboard']);

Route::get('google-drive/authenticate', [GoogleDriveController::class, 'authenticate'])->name('google-drive.authenticate');
Route::get('/google-drive/redirect', [GoogleDriveController::class, 'redirectToGoogle'])->name('google-drive.redirect');


Route::get('/google-drive/callback', [GoogleDriveController::class, 'handleCallback'])->name('google-drive.callback');

Route::get('google-drive/upload', [GoogleDriveController::class, 'showUploadForm'])->name('google-drive.upload-form');
Route::post('google-drive/upload', [GoogleDriveController::class, 'upload'])->name('google-drive.upload');
Route::get('google-drive/files', [GoogleDriveController::class, 'listFiles'])->name('google-drive.files');

Route::resource('/katalog', KatalogController::class);

Route::get('/tentang', [KatalogController::class, 'tentang'])->name('tentang');

Route::get('/produk', [KatalogController::class, 'produk'])->name('produk');

Route::get('/alamat', [KatalogController::class, 'alamat'])->name('alamat');

Route::get('/kontak', [KatalogController::class, 'kontak'])->name('kontak');

Route::get('barang_masuk/create', [BarangMasukController::class, 'create'])->name('barang_masuk.create');

Route::middleware(['auth', 'check.level:1'])->group(function () {
    Route::get('/admin', [UserController::class, 'adminDashboard'])->name('dashboard.admin');
});

Route::middleware(['auth', 'check.level:2'])->group(function () {
    Route::get('/karyawan', [UserController::class, 'karyawanDashboard'])->name('dashboard.karyawan');
});

Route::get('/auth/redirect', [SocialiteController::class, 'redirect']); 
Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);



