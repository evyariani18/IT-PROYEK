<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Barang_Masuk;
use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Http\Request;

class Dashboard2Controller extends Controller
{
    public function home(){
        // Akses data dari model
        $brands = Brand::all();
        $categories = Category::all();
        $barangMasuk = Barang_Masuk::all();
        $transaksi = Transaksi::all();
        $barangs = Barang::all();

        // Mengganti nama variabel yang tidak konsisten
        return view('dashboard', compact('brands', 'categories', 'barangMasuk', 'transaksi', 'barangs'));
    }

    public function tentang(){
        return view('tentang');
    }

    public function kontak(){
        return view('kontak');
    }
}
