<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\SendStockAlert;

// Menambahkan command dengan signature dan closure
Artisan::command('cek:stok', function () {
    $this->call(SendStockAlert::class);
})->everyMinute();  // Atur interval penjadwalan di sini

