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
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query data dengan filter tanggal
        $query = Pembelian::with('details');

        if ($startDate) {
            $query->where('tanggal_pembelian', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('tanggal_pembelian', '<=', $endDate);
        }

        // Paginate hasil query
        $pembelian = $query->paginate(10);
        return view('laporan_pembelian.index', compact('pembelian', 'startDate', 'endDate'));
    }

    public function cetak_pdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Query data dengan filter tanggal
        $query = Pembelian::with('details');
    
        if ($startDate) {
            $query->where('tanggal_pembelian', '>=', $startDate);
        }
    
        if ($endDate) {
            $query->where('tanggal_pembelian', '<=', $endDate);
        }
    
        // Ambil data yang sudah difilter
        $pembelian = $query->get(); // menggunakan get() karena kita tidak memerlukan paginasi di PDF
    
        // Cetak PDF
        $pdf = PDF::loadview('laporan_pembelian.pembelian_pdf', ['pembelian' => $pembelian, 'startDate' => $startDate, 'endDate' => $endDate]);
        
        $filename = 'laporan_pembelian_' . $startDate . '_' . $endDate . '.pdf';
    
        return $pdf->download($filename);
    }
    
}
