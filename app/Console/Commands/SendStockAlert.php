<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\BarangController;

class SendStockAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cek:stok';
    protected $description = 'Periksa stok barang dan kirim notifikasi';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        (new BarangController())->cekStok();
    }

}
