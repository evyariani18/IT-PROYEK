<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    // Method untuk menampilkan daftar produk
    public function index()
    {
        $katalogs = Katalog::all(); // Mengambil semua data produk dari database
        return view('katalog.index', compact('katalogs'));
    }

    // Method untuk menampilkan halaman create produk
    public function create()
    {
        return view('katalog.create');
    }

    // Method untuk menyimpan produk baru
    public function store(Request $request)
    {
        // Validasi inputan form
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|max:2048',
        ]);

        // Menyimpan gambar produk jika ada
        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('public/images');
        }

        // Menyimpan produk baru ke database
        Katalog::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $gambar,
        ]);

        return redirect()->route('katalog.index')->with('success', 'Produk berhasil ditambahkan');
    }

    // Method untuk menampilkan halaman edit produk
    public function edit($id)
    {
        $katalog = Katalog::findOrFail($id); // Menampilkan produk berdasarkan ID
        return view('katalog.edit', compact('katalog'));
    }

    // Method untuk mengupdate produk yang sudah ada
    public function update(Request $request, $id)
    {
        // Validasi inputan form
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $katalog = Katalog::findOrFail($id); // Mencari produk berdasarkan ID

        // Menyimpan gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($katalog->gambar) {
                Storage::delete($katalog->gambar);
            }
            $gambar = $request->file('gambar')->store('public/images');
        } else {
            $gambar = $katalog->gambar; // Jika tidak ada gambar baru, tetap menggunakan gambar lama
        }

        // Mengupdate produk dengan data baru
        $katalog->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $gambar,
        ]);

        return redirect()->route('katalog.index')->with('success', 'Produk berhasil diperbarui');
    }

    // Method untuk menghapus produk
    public function destroy($id)
    {
        $katalog = Katalog::findOrFail($id);

        // Hapus gambar dari storage
        if ($katalog->gambar) {
            Storage::delete($katalog->gambar);
        }

        // Hapus data produk dari database
        $katalog->delete();

        return redirect()->route('katalog.index')->with('success', 'Produk berhasil dihapus');
    }
}
