<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Barang; // Pastikan Anda mengimpor model Barang
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
    {
        $transaksis = Transaksi::paginate(10);
        return view('transaksi.index', compact('transaksis'));
    }

    // Menampilkan form untuk menambah transaksi
    public function create()
    {
        // Ambil semua data barang
        $barangs = Barang::all(); 
        return view('transaksi.create', compact('barangs')); // Kirim data barang ke view
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_barang' => 'required|integer|exists:barang,id_barang', // Memastikan id_barang ada di tabel barang
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'tanggal_transaksi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        // Hitung total harga
        $harga_total = $request->jumlah * $request->harga_satuan;

        try {
            // Pastikan pengguna sudah login
            if (!auth()->check()) {
                return redirect()->back()->with('error', 'Anda harus login untuk menyimpan transaksi.');
            }

            // Buat transaksi baru
            Transaksi::create([
                'id_transaksi' => uniqid('trx_'), // Buat ID unik untuk transaksi
                'id_user' => auth()->id(), // ID pengguna yang sedang login
                'id_barang' => $request->id_barang,
                'jumlah' => $request->jumlah,
                'harga_satuan' => $request->harga_satuan,
                'harga_total' => $harga_total,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'keterangan' => $request->keterangan,
            ]);
        } catch (\Exception $e) {
            \Log::error('Gagal menyimpan transaksi: ' . $e->getMessage()); // Logging error
            return redirect()->back()->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
        }

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit transaksi
    public function edit($id)
    {
        $transaksi = Transaksi::where('id_transaksi', $id)->firstOrFail();
        return view('transaksi.edit', compact('transaksi'));
    }

    // Memperbarui transaksi
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::where('id_transaksi', $id)->firstOrFail();

        $request->validate([
            'id_barang' => 'required|integer|exists:barang,id_barang', // Memastikan id_barang ada di tabel barang
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'tanggal_transaksi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $harga_total = $request->jumlah * $request->harga_satuan;

        $transaksi->update([
            'id_barang' => $request->id_barang,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $request->harga_satuan,
            'harga_total' => $harga_total,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    // Menghapus transaksi
    public function destroy($id)
    {
        $transaksi = Transaksi::where('id_transaksi', $id)->firstOrFail();
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    // Mengambil data barang berdasarkan transaksi
    public function getDataBarang($transaksi)
    {
        $transaksi = Transaksi::with(['barangmasuk.barang', 'barangkeluar.barang'])
            ->where('id_transaksi', $transaksi)
            ->first();

        $barangmasuk = $transaksi->barangmasuk->map(function($barangmasuk) {
            return [
                'id_barang' => $barangmasuk->barang->id_barang,
                'name' => $barangmasuk->barang->name,
                'jumlah' => $barangmasuk->jumlah,
            ];
        });

        $barangkeluar = $transaksi->barangkeluar->map(function($barangkeluar) {
            return [
                'id_barang' => $barangkeluar->barang->id_barang,
                'name' => $barangkeluar->barang->name,
                'jumlah' => $barangkeluar->jumlah,
            ];
        });

        return response()->json([
            'transaksi' => $transaksi,
            'barangmasuk' => $barangmasuk,
            'barangkeluar' => $barangkeluar,
        ]);
    }
}
