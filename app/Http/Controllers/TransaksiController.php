<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use App\Models\Barang; // Pastikan Anda mengimpor model Barang
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
    {
        $transaksi = Transaksi::paginate(10);
        return view('transaksi.index', compact('transaksi'));
    }

    // Menampilkan form untuk menambah transaksi
    public function create()
    {
        // Ambil semua data barang
        $barang = Barang::all(); 

        return view('transaksi.create', compact('barang')); // Kirim data barang ke view
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_barang' => 'required|exists:barang,id_barang',// Memastikan id_barang ada di tabel barang
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'harga_total' => 'required|numeric|min:0',
            'tanggal_transaksi' => 'required|date|before_or_equal:today',
            'keterangan' => 'nullable|string',
        ]);

        $tanggal_transaksi = $request->tanggal_transaksi ?: now()->toDateString();

        // Hitung total harga
        $harga_total = $request->jumlah * $request->harga_satuan;


            $lastTransaksi = Transaksi::orderBy('id_transaksi', 'desc')->first();
            $newIdTransaksi = $lastTransaksi ? 'T' . str_pad((intval(substr($lastTransaksi->id_transaksi, 1)) + 1), 3, '0', STR_PAD_LEFT) : 'T001';

            // Buat transaksi baru
            Transaksi::create([
                'id_transaksi' => $newIdTransaksi, // Buat ID unik untuk transaksi
                'id_barang' => $request->id_barang,
                'harga_satuan' => $request->harga_satuan,
                'jumlah' => $request->jumlah,
                'harga_total' => $harga_total,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'keterangan' => $request->keterangan,
            ]);

            $barang = Barang::find($request->id_barang);
            $barang->stok -= $request->jumlah;
            $barang->save(); // Simpan perubahan status

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }


    // Menampilkan form untuk mengedit transaksi
    public function edit($id_transaksi)
    {
        $transaksi = Transaksi::findOrFail( $id_transaksi);
        $barang = Barang::all();
        return view('transaksi.edit', compact('transaksi', 'barang'));
    }

    // Memperbarui transaksi
    public function update(Request $request, $id_transaksi)
    {
        $transaksi = Transaksi::findOrFail($id_transaksi);

        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang', // Memastikan id_barang ada di tabel barang
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'harga_total' => 'required|numeric|min:0',
            'tanggal_transaksi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $harga_total = $request->jumlah * $request->harga_satuan;

        // Ambil data barang terkait transaksi yang akan diupdate
        $barang = Barang::find($request->id_barang);
        
        // Hitung selisih jumlah
        $selisih = $transaksi->jumlah - $request->jumlah;
    
        // Jika jumlah yang diupdate lebih kecil, tambahkan stok yang dikurangi
        if ($selisih > 0) {
            $barang->stok += $selisih;
        } else {
            // Jika jumlah yang diupdate lebih besar, kurangi stok barang
            $barang->stok -= ($request->jumlah - $transaksi->jumlah);
        }
        $transaksi->update([
            'id_barang' => $request->id_barang,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $request->harga_satuan,
            'harga_total' => $harga_total,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'keterangan' => $request->keterangan,
        ]);

            $barang->save(); // Simpan perubahan status

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    // Menghapus transaksi
    public function destroy($id_transaksi)
    {
        $transaksi = Transaksi::findOrFail($id_transaksi);

        $barang = Barang::find($transaksi->id_barang);
        if ($barang) {
        // Kembalikan jumlah ke stok
        $barang->stok += $transaksi->jumlah;
        $barang->save(); // Simpan perubahan stok
    }
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
