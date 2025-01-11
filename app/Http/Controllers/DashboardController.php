<?php

namespace App\Http\Controllers;

// Import model yang diperlukan
use App\Models\Penjualan;
use App\Models\Detail_Penjualan;

// Import class yang diperlukan
use Carbon\Carbon; // Ditambahkan untuk penggunaan Carbon
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengembalikan view dashboard
        return view('dashboard');
    }

    /**
     * Mengambil data penjualan per bulan dan mengembalikannya dalam format JSON.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPenjualanPerBulan()
    {
        // Mengambil data penjualan yang dikelompokkan berdasarkan bulan
        $data = Penjualan::selectRaw('MONTH(tanggal_penjualan) as bulan, SUM(total) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Mengembalikan data sebagai JSON
        return response()->json($data);
    }

    /**
     * Mengambil data penjualan yang dikelompokkan berdasarkan bulan, dan mengirimnya ke view.
     *
     * @return \Illuminate\View\View
     */
    public function getPenjualan()
    {
        // Mengambil semua data penjualan
        $penjualan = Penjualan::all();
    
        // Mengelompokkan data penjualan berdasarkan bulan (format Tahun-Bulan)
        $penjualanGrouped = $penjualan->groupBy(function ($date) {
            return Carbon::parse($date->tanggal_penjualan)->format('Y-m'); // Mengelompokkan berdasarkan bulan (Tahun-Bulan)
        });
    
        // Mengambil daftar bulan sebagai label untuk sumbu X
        $bulan = $penjualanGrouped->keys();
    
        // Menghitung total penjualan untuk setiap bulan
        $total = $penjualanGrouped->map(function ($item) {
            return $item->sum('total');
        });
    
        // Mengirim data bulan dan total penjualan ke view
        return view('dashboard', compact('bulan', 'total'));
    }
}
