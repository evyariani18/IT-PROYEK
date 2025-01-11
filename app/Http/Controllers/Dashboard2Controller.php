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
    public function index()
    {
        return view('dashboard2');
    }
}