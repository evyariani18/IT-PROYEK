<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Detail_Penjualan;
use App\Models\Barang;

class LaporanPenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::with('details')->paginate(10);
        return view('laporan_penjualan.index', compact('penjualan'));
    }
}
