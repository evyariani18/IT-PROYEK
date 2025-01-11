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
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query data dengan filter tanggal
        $query = Penjualan::with('details');

        if ($startDate) {
            $query->where('tanggal_penjualan', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('tanggal_penjualan', '<=', $endDate);
        }

        // Paginate hasil query
        $penjualan = $query->paginate(10);
    
        return view('laporan_penjualan.index', compact('penjualan', 'startDate', 'endDate'));
    }

    public function cetak_pdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Query data dengan filter tanggal
        $query = Penjualan::with('details');
    
        if ($startDate) {
            $query->where('tanggal_penjualan', '>=', $startDate);
        }
    
        if ($endDate) {
            $query->where('tanggal_penjualan', '<=', $endDate);
        }
    
        // Ambil data yang sudah difilter
        $penjualan = $query->get(); // menggunakan get() karena kita tidak memerlukan paginasi di PDF
    
        // Cetak PDF
        $pdf = PDF::loadview('laporan_penjualan.penjualan_pdf', ['penjualan' => $penjualan, 'startDate' => $startDate, 'endDate' => $endDate]);
        
        $filename = 'laporan_penjualan_' . $startDate . '_' . $endDate . '.pdf';
    
        return $pdf->download($filename);
    }
    
}
