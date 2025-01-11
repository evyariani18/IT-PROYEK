<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Penjualan;
use PDF;
use Illuminate\Support\Facades\Http;

class SendMonthlyReport extends Command
{
    protected $signature = 'report:send';
    protected $description = 'Kirim laporan penjualan setiap akhir bulan';

    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        //
    }
}
