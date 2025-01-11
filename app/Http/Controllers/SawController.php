<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Detail_Pembelian;
use App\Models\Detail_Penjualan;

class SawController extends Controller
{
    public function index(){
        $barang = Barang::with(['detail_pembelian', 'detail_penjualan'])->get();

        $barangProcessed = $barang->map(function ($item) {
            // Menghitung keuntungan
            $keuntungan = 0;
            $totalKeuntungan = 0;
            $jumlahTerjual = 0;
    
            // Pastikan ada data detail_pembelian dan detail_penjualan
            if ($item->detail_pembelian->isNotEmpty() && $item->detail_penjualan->isNotEmpty()) {
                $keuntungan = $item->detail_penjualan->first()->harga_satuan - $item->detail_pembelian->first()->harga_satuan;
                $totalKeuntungan = $keuntungan * $item->detail_penjualan->sum('jumlah');
            }
    
            // Jumlah yang terjual
            $jumlahTerjual = $item->detail_penjualan->sum('jumlah') ?: 0;
    
            // Menambahkan data perhitungan ke objek barang
            $item->total_keuntungan = $totalKeuntungan;
            $item->jumlah_terjual = $jumlahTerjual;
    
            return $item;
        });

        return view('/prioritas_stok.index', compact('barangProcessed'));
    }

        public function show(Request $request){
        
            $barang = Barang::with(['detail_pembelian', 'detail_penjualan'])->get();

            $barangProcessed = $barang->map(function ($item) {
                // Menghitung keuntungan
                $keuntungan = 0;
                $totalKeuntungan = 0;
                $jumlahTerjual = 0;
        
                // Pastikan ada data detail_pembelian dan detail_penjualan
                if ($item->detail_pembelian->isNotEmpty() && $item->detail_penjualan->isNotEmpty()) {
                    $keuntungan = $item->detail_penjualan->first()->harga_satuan - $item->detail_pembelian->first()->harga_satuan;
                    $totalKeuntungan = $keuntungan * $item->detail_penjualan->sum('jumlah');
                } else {
                    $totalKeuntungan = 1;
                }
                
        
                // Jumlah yang terjual
                $jumlahTerjual = $item->detail_penjualan->sum('jumlah') ?: 1;
        
                // Menambahkan data perhitungan ke objek barang
                $item->total_keuntungan = $totalKeuntungan;
                $item->jumlah_terjual = $jumlahTerjual;
        
                return $item;
            });

        $bobot = [
            'harga' => 0.2,    // Bobot harga
            'stok' => 0.35,     // Bobot stok
            'profit' => 0.25,   // Bobot profit
            'terjual' => 0.2   // Bobot jumlah terjual
        ];
        
        // Tentukan jenis kriteria
        $jenisKriteria = [
            'harga' => 'benefit',  // Kriteria harga adalah benefit
            'stok' => 'cost',    // Kriteria stok adalah cost
            'profit' => 'benefit', // Kriteria profit adalah benefit
            'terjual' => 'benefit' // Kriteria terjual adalah benefit
        ];

        //menentukan max min
        $nilaiKriteria = [
            'harga' => [
                'max' => $barangProcessed->max('harga'),
                'min' => $barangProcessed->min('harga')
            ],
            'stok' => [
                'max' => $barangProcessed->max('stok'),
                'min' => $barangProcessed->min('stok')
            ],
            'profit' => [
                'max' => $barangProcessed->max('total_keuntungan'),
                'min' => $barangProcessed->min('total_keuntungan')
            ],
            'terjual' => [
                'max' => $barangProcessed->max('jumlah_terjual'),
                'min' => $barangProcessed->min('jumlah_terjual')
            ]
        ];
        
        $barangProcessed = $barangProcessed->map(function ($item) use ($bobot, $jenisKriteria, $nilaiKriteria) {
            // Normalisasi untuk setiap kriteria berdasarkan jenis kriteria
            if ($jenisKriteria['harga'] == 'benefit') {
                $normHarga = $item->harga / $nilaiKriteria['harga']['max'];
            } else { // cost
                $normHarga = $nilaiKriteria['harga']['min'] / $item->harga;
            }
    
            if ($jenisKriteria['stok'] == 'benefit') {
                $normStok = $item->stok / $nilaiKriteria['stok']['max'];
            }  else { // cost
                if ($item->stok == 0) {
                    $item->stok = 1; // Jika stok = 0, set stok menjadi 1
                }
                $normStok = $nilaiKriteria['stok']['min'] / $item->stok;
            }
    
            if ($jenisKriteria['profit'] == 'benefit') {
                $normKeuntungan = $item->total_keuntungan / $nilaiKriteria['profit']['max'];
            } else { // cost
                $normKeuntungan = $nilaiKriteria['profit']['min'] / $item->total_keuntungan;
            }
    
            if ($jenisKriteria['terjual'] == 'benefit') {
                $normTerjual = $item->jumlah_terjual / $nilaiKriteria['terjual']['max'];
            } else { // cost
                $normTerjual = $nilaiKriteria['terjual']['min'] / $item->jumlah_terjual;
            }

            // Menambahkan hasil normalisasi ke barang
            $item->normHarga = $normHarga;
            $item->normStok = $normStok;
            $item->normKeuntungan = $normKeuntungan;
            $item->normTerjual = $normTerjual;

            //menghitung skor SAW
                $skorSAW = ($normHarga * $bobot['harga']) + 
                    ($normStok * $bobot['stok']) + 
                    ($normKeuntungan * $bobot['profit']) + 
                    ($normTerjual * $bobot['terjual']);

            // Menambahkan skor SAW ke barang
            $item->skor_saw = $skorSAW;

            return $item;
        });

        $barangProcessed = $barangProcessed->sortByDesc('skor_saw')->values();

        return view('prioritas_stok.show', compact('barangProcessed'));
    }
}
    
