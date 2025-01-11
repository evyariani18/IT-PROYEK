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
    public function index(Request $request){

        // Ambil parameter filter tanggal
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query data pembelian dengan filter tanggal
        $query = Penjualan::with('details');

        if ($startDate) {
            $query->where('tanggal_penjualan', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('tanggal_penjualan', '<=', $endDate);
        }


        $penjualan = $query->paginate(10);

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
        Log::info('Memperbarui data penjualan:', $request->all());
    
        // Validate the incoming request data
        $request->validate([
            'tanggal_penjualan' => 'required|date|before_or_equal:today',
            'keterangan' => 'nullable|string',
            'details' => 'required|array',
            'details.*.id_barang' => 'required|exists:barang,id_barang',
            'details.*.jumlah' => 'required|integer|min:1',
            'details.*.harga_satuan' => 'required|numeric|min:0',
        ]);
    
        // Find the existing penjualan record
        $penjualan = Penjualan::findOrFail($id_penjualan);
    
        // Fetch old details
        $oldDetails = Detail_Penjualan::where('id_penjualan', $penjualan->id_penjualan)->get()->keyBy('id_barang');
    
        // Recalculate total harga penjualan
        $totalHarga = collect($request->details)->sum(function ($item) {
            return $item['jumlah'] * $item['harga_satuan'];
        });
    
        // Update penjualan record
        $penjualan->update([
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'total_harga' => $totalHarga,
            'keterangan' => $request->keterangan,
        ]);
    
        // Process and update details
        foreach ($request->details as $item) {
            $barang = Barang::find($item['id_barang']);
            if (!$barang) {
                return back()->withErrors(['error' => 'Barang tidak ditemukan: ' . $item['id_barang']]);
            }
    
            $subtotal = $item['jumlah'] * $item['harga_satuan'];
    
            if ($oldDetails->has($item['id_barang'])) {
                $oldDetail = $oldDetails->get($item['id_barang']);
                $stokChange = $oldDetail->jumlah - $item['jumlah'];
    
                // Update stock based on the difference
                $barang->stok += $stokChange;
    
                if ($barang->stok < 0) {
                    return back()->withErrors(['error' => 'Stok tidak mencukupi untuk barang: ' . $barang->name]);
                }
    
                $barang->save();
    
                // Update the detail record
                $oldDetail->update([
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $item['harga_satuan'],
                    'sub_total' => $subtotal,
                ]);
            } else {
                // New detail item
                if ($barang->stok < $item['jumlah']) {
                    return back()->withErrors(['error' => 'Stok tidak mencukupi untuk barang: ' . $barang->name]);
                }
    
                $barang->stok -= $item['jumlah'];
                $barang->save();
    
                Detail_Penjualan::create([
                    'id_penjualan' => $penjualan->id_penjualan,
                    'id_barang' => $item['id_barang'],
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $item['harga_satuan'],
                    'sub_total' => $subtotal,
                ]);
            }
        }
    
        // Delete details that were removed in the update
        foreach ($oldDetails as $id_barang => $detail) {
            if (!collect($request->details)->pluck('id_barang')->contains($id_barang)) {
                // Restore stock for removed details
                $barang = Barang::find($id_barang);
                if ($barang) {
                    $barang->stok += $detail->jumlah;
                    $barang->save();
                }
    
                // Delete the detail
                $detail->delete();
            }
        }
    
        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil diperbarui.');
    }
    
    
    
    public function show($id_penjualan)
    {
        $penjualan = Penjualan::with('details.barang')->findOrFail($id_penjualan);

        return view('penjualan.show', compact('penjualan'));
    }
    
    public function destroy($id_penjualan)
    {
        $penjualan = Penjualan::findOrFail($id_penjualan);

        // Ambil semua detail penjualan terkait
        $details = Detail_Penjualan::where('id_penjualan', $penjualan->id_penjualan)->get();

        foreach ($details as $detail) {
            // Cari barang terkait
            $barang = Barang::find($detail->id_barang);

            if ($barang) {
                // Kembalikan stok barang
                $barang->stok += $detail->jumlah;
                $barang->save();
            }
        }

        // Hapus semua detail penjualan terkait
        Detail_Penjualan::where('id_penjualan', $penjualan->id_penjualan)->delete();

        // Hapus data penjualan
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil dihapus dan stok barang telah diperbarui.');
    }



    public function cetak_pdf($id_penjualan)
    {
        $penjualan = Penjualan::with('details.barang')->findOrFail($id_penjualan);
        $pdf = PDF::loadview('penjualan.cetak_penjualan', ['penjualan' => $penjualan]);
        return $pdf->download("nota_penjualan_{$id_penjualan}.pdf");
    }

    public function dashboard(Request $request)
    {
        // Ambil data penjualan per bulan dalam tahun ini
        $year = $request->input('year', date('Y')); // default tahun ini
        $penjualanPerMonth = Penjualan::select(
                DB::raw('MONTH(tanggal_penjualan) as month'),
                DB::raw('SUM(total_harga) as total_penjualan')
            )
            ->whereYear('tanggal_penjualan', $year)
            ->groupBy(DB::raw('MONTH(tanggal_penjualan)'))
            ->orderBy('month')
            ->get();

            dd($penjualanPerMonth);
        
        // Siapkan data untuk chart
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $salesData = array_fill(0, 12, 0); // Inisialisasi array untuk setiap bulan

        foreach ($penjualanPerMonth as $data) {
            $salesData[$data->month - 1] = $data->total_penjualan;
        }

        return view('dashboard', compact('salesData', 'months', 'year'));
    }
}

