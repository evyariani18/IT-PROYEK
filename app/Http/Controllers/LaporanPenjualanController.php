<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Detail_Penjualan;
use App\Models\Barang;
use PDF;

class LaporanPenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::with('details')->paginate(10);
        return view('laporan_penjualan.index', compact('penjualan'));
    }
    public function cetak_pdf()
    {
        $penjualan = Penjualan::with('details')->paginate(10);
        $pdf = PDF::loadview('laporan_penjualan.penjualan_pdf', ['penjualan' => $penjualan]);
        return $pdf->download('laporan_penjualan-pdf');
    }
}
