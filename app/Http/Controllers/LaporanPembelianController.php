<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Detail_Pembelian;
use App\Models\Barang;
use PDF;

class LaporanPembelianController extends Controller
{
    // UserController
    public function index()
    {
        $pembelian = Pembelian::with('details')->paginate(10);
        return view('laporan_pembelian.index', compact('pembelian'));
    }

    public function cetak_pdf()
    {
        $pembelian = Pembelian::with('details')->paginate(10);
        $pdf = PDF::loadview('laporan_pembelian.pembelian_pdf', ['pembelian' => $pembelian]);
        return $pdf->download('laporan_pembelian-pdf');
    }
}
