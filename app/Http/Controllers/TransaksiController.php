<?php

namespace App\Http\Controllers;

use App\Models\Transaksi; // Pastikan model Transaksi sudah ada
use App\Models\Barang;    // Pastikan model Barang sudah ada
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
    {
        // Mengambil semua transaksi dengan relasi ke barang
        $transaksis = Transaksi::with('barang')->paginate(10);
        return view('transaksi.index', compact('transaksis')); // Menggunakan 'transaksis' dengan benar
    }

    // Menampilkan form untuk menambah transaksi
    public function create()
    {
        $barangs = Barang::all(); // Ambil semua barang untuk dropdown
        return view('transaksi.create', compact('barangs'));
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'tanggal_transaksi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        Transaksi::create([
            'id_barang' => $request->id_barang,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $request->harga_satuan,
            'harga_total' => $request->jumlah * $request->harga_satuan,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit transaksi
    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $barangs = Barang::all(); // Ambil semua barang untuk dropdown
        return view('transaksi.edit', compact('transaksi', 'barangs'));
    }

    // Memperbarui transaksi
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $request->validate([
            'id_barang' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'tanggal_transaksi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $transaksi->update([
            'id_barang' => $request->id_barang,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $request->harga_satuan,
            'harga_total' => $request->jumlah * $request->harga_satuan,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    // Menghapus transaksi
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
