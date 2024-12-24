<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang; // import class
use App\Models\Penjualan;
use App\Models\Detail_Penjualan;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use PDF;

class PenjualanController extends Controller
{
    public function index(){
        $penjualan = Penjualan::with('details')->paginate(10);

        return view('penjualan.index', compact('penjualan'));
    }

    public function create(){
        $barang = Barang::all();
        return view('penjualan.create', compact('barang'));
    }

    public function store(Request $request)
    {
        Log::info('Menyimpan data penjualan:', $request->all());

        // Validate the incoming request data
        $request->validate([
            'tanggal_penjualan' => 'required|date|before_or_equal:today',
            'keterangan' => 'nullable|string',
            'details' => 'required|array', // Validasi array item
            'details.*.id_barang' => 'required|exists:barang,id_barang',
            'details.*.jumlah' => 'required|integer|min:1',
            'details.*.harga_satuan' => 'required|numeric|min:0',
        ]);

        // Hitung total harga penjualan
        $totalHarga = collect($request->details)->sum(function ($item) {
            return $item['jumlah'] * $item['harga_satuan'];
        });

        // Get the last penjualan record and generate a new ID
        $lastPenjualan = Penjualan::orderBy('id_penjualan', 'desc')->first();
        $newIdPenjualan = $lastPenjualan 
            ? 'PJ' . str_pad((intval(substr($lastPenjualan->id_penjualan, 2)) + 1), 6, '0', STR_PAD_LEFT)
            : 'PJ000001';

        // Create new penjualan record
        $penjualan = Penjualan::create([
            'id_penjualan' => $newIdPenjualan,
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'total_harga' => $totalHarga,
            'keterangan' => $request->keterangan,
        ]);

        // Process each item in the sale
        foreach ($request->details as $item) {
            $subtotal = $item['jumlah'] * $item['harga_satuan'];

            // Create the detail penjualan record
            Detail_Penjualan::create([
                'id_penjualan' => $penjualan->id_penjualan,
                'id_barang' => $item['id_barang'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $item['harga_satuan'],
                'sub_total' => $subtotal,
            ]);

            // Update the stock of the sold barang
            $barang = Barang::find($item['id_barang']);
            if ($barang) {
                if ($barang->stok < $item['jumlah']) {
                    // Return error if stock is insufficient
                    return back()->withErrors(['error' => 'Stok tidak mencukupi untuk barang: ' . $barang->name]);
                }
                $barang->stok -= $item['jumlah'];
                $barang->save();
            } else {
                // Return error if the barang is not found
                return back()->withErrors(['error' => 'Barang tidak ditemukan: ' . $item['id_barang']]);
            }
        }

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil disimpan.');
    }

    public function edit($id_penjualan)
    {
        $penjualan = Penjualan::with('details')->findOrFail($id_penjualan);
        $barang = Barang::all(); // Untuk dropdown barang jika diperlukan

        return view('penjualan.edit', compact('penjualan', 'barang'));
    }

    public function update(Request $request, $id_penjualan)
    {
        $request->validate([
            'tanggal_penjualan' => 'required|date|before_or_equal:today',
            'keterangan' => 'nullable|string',
            'details' => 'required|array',
            'details.*.id_barang' => 'required|exists:barang,id_barang',
            'details.*.jumlah' => 'required|integer|min:1',
            'details.*.harga_satuan' => 'required|numeric|min:0',
        ]);

        dd($request->all());
    
        $penjualan = Penjualan::findOrFail($id_penjualan);
        $penjualan->update([
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'keterangan' => $request->keterangan,
        ]);
    
        $totalHarga = 0;
    
        // Hapus detail lama
        Detail_Penjualan::where('id_penjualan', $penjualan->id_penjualan)->delete();
    
        // Tambahkan detail baru
        $lastDetailPenjualan = Detail_Penjualan::orderBy('id_detailjual', 'desc')->first();
        $newIdDetailPenjualan = $lastDetailPenjualan ? 'DJ' . str_pad((intval(substr($lastDetailPenjualan->id_detailjual, 2)) + 1), 6, '0', STR_PAD_LEFT) : 'DJ000001';
    
        foreach ($request->details as $detail) {
            $subtotal = $detail['jumlah'] * $detail['harga_satuan'];
            $totalHarga += $subtotal;
    
            Detail_Penjualan::create([
                'id_detailjual' => $newIdDetailPenjualan,
                'id_penjualan' => $penjualan->id_penjualan,
                'id_barang' => $detail['id_barang'],
                'jumlah' => $detail['jumlah'],
                'harga_satuan' => $detail['harga_satuan'],
                'subtotal' => $subtotal,
            ]);
    
            // Increment ID detail
            $newIdDetailPenjualan = 'DJ' . str_pad((intval(substr($newIdDetailPenjualan, 2)) + 1), 6, '0', STR_PAD_LEFT);
        }
    
        $penjualan->update(['total_harga' => $totalHarga]);

        $barang = Barang::find($request->id_barang);
        $barang->stok -= $request->jumlah;
        $barang->save();
    
        return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil diperbarui.');
    }
    
    public function show($id_penjualan)
    {
        $penjualan = Penjualan::with('details.barang')->findOrFail($id_penjualan);

        return view('penjualan.show', compact('penjualan'));
    }
    
    public function destroy($id_penjualan)
    {
        $penjualan = Penjualan::findOrFail($id_penjualan);
    
        // Hapus semua detail penjualan terkait
        Detail_Penjualan::where('id_penjualan', $penjualan->id_penjualan)->delete();
    
        // Hapus data penjualan
        $penjualan->delete();
    
        return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil dihapus.');
    }
    public function cetak_pdf()
    {
        $penjualan = Penjualan::with('details')->get();
        $pdf = PDF::loadview('penjualan.cetak_penjualan', ['penjualan' => $penjualan]);
        return $pdf->download('cetak_penjualan-pdf');
    }
}
        