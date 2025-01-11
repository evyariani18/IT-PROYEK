<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController; // Import Controller Brand
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard2Controller; // Import Controller Dashboard
use App\Http\Controllers\BarangController; // Import Controller Barang
use App\Http\Controllers\BarangMasukController; // Import
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\GoogleDriveController;
use App\Http\Controllers\TransaksiController; // Import TransaksiController
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController; // Import LoginController/
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\DetailPembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\LaporanPembelianController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\SawController;

Route::resource('barang_masuk', BarangMasukController::class);
Route::resource('transaksi', TransaksiController::class); // Rute resource untuk transaksi



//Route untuk menampilkan form login, register dan logout

Route::get('/auth/redirect', [SocialiteController::class, 'redirect']); 
Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);


Route::get('/penjualan-per-bulan', [DashboardController::class, 'getPenjualanPerBulan']);

// Google Drive Controller
Route::get('google-drive/authenticate', [GoogleDriveController::class, 'authenticate'])->name('google-drive.authenticate');
Route::get('/google-drive/redirect', [GoogleDriveController::class, 'redirectToGoogle'])->name('google-drive.redirect');
Route::get('/google-drive/callback', [GoogleDriveController::class, 'handleCallback'])->name('google-drive.callback');
Route::get('google-drive/upload', [GoogleDriveController::class, 'showUploadForm'])->name('google-drive.upload-form');
Route::post('google-drive/upload', [GoogleDriveController::class, 'upload'])->name('google-drive.upload');
Route::get('google-drive/files', [GoogleDriveController::class, 'listFiles'])->name('google-drive.files');

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [LoginController::class, 'index'])->name('pengguna.login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

//login dan register
Route::get('/register', [LoginController::class, 'register_tampilan'])->name('pengguna.register');
Route::post('/register', [LoginController::class, 'register'])->name('register');





// Katalog Route
Route::resource('/katalog', KatalogController::class);
Route::get('/tentang', [KatalogController::class, 'tentang'])->name('tentang');
Route::get('/produk', [KatalogController::class, 'produk'])->name('produk');
Route::get('/alamat', [KatalogController::class, 'alamat'])->name('alamat');
Route::get('/kontak', [KatalogController::class, 'kontak'])->name('kontak');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard2', [Dashboard2Controller::class, 'index'])->name('dashboard2');

// Menambahkan middleware auth pada route dashboard

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard2', [Dashboard2Controller::class, 'index'])->name('dashboard2');
    
    Route::resource('brands', BrandController::class);
    
    Route::resource('categories', CategoryController::class);
    
    Route::resource('barang', BarangController::class);
    Route::get('/search-barang', [BarangController::class, 'searchBarang'])->name('searchBarang');
    
    Route::resource('users', UserController::class);
    
    Route::resource('pembelian', PembelianController::class);

    //Route untuk penjualan
    Route::resource('penjualan', PenjualanController::class);

    Route::resource('prioritas_stok', SawController::class);
    Route::get('/prioritas_stok/show', [SawController::class, 'show'])->name('prioritas_stok.show');


    Route::resource('laporan_pembelian', LaporanPembelianController::class)->except(['show']);
    Route::get('/laporan_pembelian/cetak_pdf', [LaporanPembelianController::class, 'cetak_pdf'])->name('laporan_pembelian.pembelian_pdf');

    Route::resource('laporan_penjualan', LaporanPenjualanController::class)->except(['show']);
    Route::get('/laporan_penjualan/cetak_pdf', [LaporanPenjualanController::class, 'cetak_pdf'])->name('laporan_penjualan.penjualan_pdf');

    Route::resource('pembelian', PembelianController::class)->except(['show']);
    Route::get('/cetak_pembelian/{id_pembelian}/cetak_pdf', [PembelianController::class, 'cetak_pdf'])->name('pembelian.cetak_pembelian');

    Route::resource('penjualan', PenjualanController::class)->except(['show']);
    Route::get('/cetak_penjualan/{id_penjualan}/cetak_pdf', [PenjualanController::class, 'cetak_pdf'])->name('penjualan.cetak_penjualan');

    Route::get('/cek-stok', [BarangController::class, 'cekStok'])->name('barang.cekStok');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
   