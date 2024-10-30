<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangkeluar = BarangKeluar::with('barang')->paginate(10);
        return view('barang_keluar.index', compact('barangkeluar'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('barang_keluar.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'tanggal_keluar' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $barang = Barang::findOrFail($request->id_barang);

        BarangKeluar::create([
            'id_keluar' => Str::uuid(),
            'id_barang' => $request->id_barang,
            'name' => $barang->name,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $request->harga_satuan,
            'harga_total' => $request->jumlah * $request->harga_satuan,
            'tanggal_keluar' => $request->tanggal_keluar,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('barangkeluar.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barangkeluar = BarangKeluar::findOrFail($id);
        $barangs = Barang::all();
        return view('barang_keluar.edit', compact('barangkeluar', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $barangkeluar = BarangKeluar::findOrFail($id);

        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'tanggal_keluar' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $barang = Barang::findOrFail($request->id_barang);

        $barangkeluar->update([
            'id_barang' => $request->id_barang,
            'name' => $barang->name,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $request->harga_satuan,
            'harga_total' => $request->jumlah * $request->harga_satuan,
            'tanggal_keluar' => $request->tanggal_keluar,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('barangkeluar.index')->with('success', 'Barang berhasil diedit!');
    }

    public function destroy($id)
    {
        $barangkeluar = BarangKeluar::findOrFail($id);
        
        try {
            $barangkeluar->delete();
            return redirect()->route('barangkeluar.index')->with('success', 'Barang berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('barangkeluar.index')->with('error', 'Barang gagal dihapus!');
        }
    }
}
