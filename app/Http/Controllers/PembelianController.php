<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembelian; // import model
use App\Models\Barang; // import barang model
use App\Models\Detail_Pembelian; // import detail pembelian model
use PDF;

class PembelianController extends Controller
{

    public function index(Request $request)
    {
        // Ambil parameter filter tanggal
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query data pembelian dengan filter tanggal
        $query = Pembelian::with('details');

        if ($startDate) {
            $query->where('tanggal_pembelian', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('tanggal_pembelian', '<=', $endDate);
        }

        // Paginate hasil query
        $pembelian = $query->paginate(10);

        return view('pembelian.index', compact('pembelian'));
    }

    public function show($id_pembelian)
    {
        // Fetch pembelian with details and barang relation
        $pembelian = Pembelian::with('details.barang')->findOrFail($id_pembelian);

        return view('pembelian.show', compact('pembelian'));
    }

    public function create()
    {
        // Fetch all barang for dropdown
        $barang = Barang::all();

        return view('pembelian.create', compact('barang'));
    }

    public function store(Request $request)
    {
        Log::info('Menyimpan data pembelian:', $request->all());

        // Validate the incoming request data
        $request->validate([
            'tanggal_pembelian' => 'required|date',
            'supplier' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240', // Validasi file nota
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'details' => 'required|array', // Validasi array item
            'details.*.id_barang' => 'required|exists:barang,id_barang',
            'details.*.jumlah' => 'required|integer|min:1',
            'details.*.harga_satuan' => 'required|numeric|min:0',
        ]);

        // Hitung total harga pembelian
        $totalHarga = collect($request->details)->sum(function ($item) {
            return $item['jumlah'] * $item['harga_satuan'];
        });

        // Get the last pembelian record and generate a new ID
        $lastPembelian = Pembelian::orderBy('id_pembelian', 'desc')->first();
        $newIdPembelian = $lastPembelian 
            ? 'PB' . str_pad((intval(substr($lastPembelian->id_pembelian, 2)) + 1), 6, '0', STR_PAD_LEFT)
            : 'PB000001';

        // Create new pembelian record
        $pembelian = Pembelian::create([
            'id_pembelian' => $newIdPembelian,
            'tanggal_pembelian' => $request->tanggal_pembelian,
            'supplier' => $request->supplier,
            'total_harga' => $totalHarga,
            'image' => $request->file('image') ? $request->file('image')->store('images', 'public') : null
        ]);

        // Process each item in the purchase
        foreach ($request->details as $item) {
            $subtotal = $item['jumlah'] * $item['harga_satuan'];

            // Create the detail pembelian record
            Detail_Pembelian::create([
                'id_pembelian' => $pembelian->id_pembelian,
                'id_barang' => $item['id_barang'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $item['harga_satuan'],
                'sub_total' => $subtotal,
            ]);

            // Update the stock of the purchased barang
            $barang = Barang::find($item['id_barang']);
            $barang->stok += $item['jumlah'];
            $barang->save();
        }

        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil disimpan.');
    }

    public function edit($id_pembelian)
    {
        // Fetch the pembelian record with its details for editing
        $pembelian = Pembelian::with('details')->findOrFail($id_pembelian);
        $barang = Barang::all(); // For dropdown in form

        return view('pembelian.edit', compact('pembelian', 'barang'));
    }

    public function update(Request $request, $id_pembelian)
    {
        // Validate the incoming request data
        $request->validate([
            'tanggal_pembelian' => 'required|date',
            'supplier' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'details' => 'required|array', // Validasi array item
            'details.*.id_barang' => 'required|exists:barang,id_barang',
            'details.*.jumlah' => 'required|integer|min:1',
            'details.*.harga_satuan' => 'required|numeric|min:0',
        ]);

        $pembelian = Pembelian::findOrFail($id_pembelian);

        // Cek dan perbarui gambar jika ada upload baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($pembelian->image && \Storage::disk('public')->exists($pembelian->image)) {
                \Storage::disk('public')->delete($pembelian->image);
            }
            // Simpan gambar baru
            $imagePath = $request->file('image')->store('images', 'public');
            $pembelian->image = $imagePath;
        }
        $pembelian->update([
            'tanggal_pembelian' => $request->tanggal_pembelian,
            'supplier' => $request->supplier,
        ]);

        $totalHarga = 0;

        // Hapus detail lama
        Detail_Pembelian::where('id_pembelian', $pembelian->id_pembelian)->delete();

        // Tambahkan detail baru
        foreach ($request->details as $item) {
            $subtotal = $item['jumlah'] * $item['harga_satuan'];
            $totalHarga += $subtotal;

            Detail_Pembelian::create([
                'id_pembelian' => $pembelian->id_pembelian,
                'id_barang' => $item['id_barang'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $item['harga_satuan'],
                'sub_total' => $subtotal,
            ]);

            // Update stock for barang
            $barang = Barang::find($item['id_barang']);
            $barang->stok += $item['jumlah'];
            $barang->save();
        }

        $pembelian->update(['total_harga' => $totalHarga]);

        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil diperbarui.');
    }

    public function destroy($id_pembelian)
    {
        $pembelian = Pembelian::findOrFail($id_pembelian);

        // Hapus semua detail pembelian terkait
        Detail_Pembelian::where('id_pembelian', $pembelian->id_pembelian)->delete();

        // Hapus data pembelian
        $pembelian->delete();

        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil dihapus.');
    }
    public function cetak_pdf($id_pembelian)
    {
        $pembelian = Pembelian::with('details.barang')->findOrFail($id_pembelian);;
        $pdf = PDF::loadview('pembelian.cetak_pembelian', ['pembelian' => $pembelian]);
        return $pdf->download("nota_pembelian_{$id_pembelian}.pdf");
    }
}
