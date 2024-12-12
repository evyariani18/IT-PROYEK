<?php

namespace App\Http\Controllers;

//import model product
use App\Models\Barang_Masuk;

//post 
use App\Models\Post;

 //import return type View
use Illuminate\View\View;

//import class
use Illuminate\Http\Request;

//mengambil data
use App\Models\Barang;
use App\Models\Brand;
use App\Models\Category;

class BarangMasukController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all products
        $barangmasuk = Barang_Masuk::with('barang')->paginate(10);
        
        //render view with products
        return view('barang_masuk.index', compact('barangmasuk'));
    }

    public function create()
    {
        //mengambil data barang
        $barang = Barang::all();
        $brands = Brand::all(); // Mengambil semua data merek
        $categories = Category::all();

        //mengembalikan 
        return view('barang_masuk.create', compact('barang', 'brands', 'categories'));
    }
    
    public function store(Request $request)
    {
        //Fungsi validasi
        $request->validate([
            'id_barang' => 'required|exists:barang,id_barang',
            'jumlah' => 'required|integer|min:1', // Pastikan stok adalah angka dan minimal 1
            'harga_satuan' => 'required|numeric|min:0',
            'harga_total' => 'required|numeric|min:0', // Harga 
            'supplier' => 'nullable|string|max:50', // supplier 
            'tanggal_masuk' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

            $id_barang = $request->input('id_barang');
    
        // Mendapatkan ID Barang terakhir dan menambahkannya dengan 1
        $lastBarangMasuk = Barang_Masuk::orderBy('id_masuk', 'desc')->first();
        $newIdBarangMasuk = $lastBarangMasuk ? 'BM' . str_pad((intval(substr($lastBarangMasuk->id_masuk, 2)) + 1), 3, '0', STR_PAD_LEFT) : 'BM001';
    
        // Menyimpan data ke database
        Barang_Masuk::create([
            'id_masuk' => $newIdBarangMasuk,
            'id_barang' => $request->id_barang,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $request->harga_satuan,
            'harga_total' => $request->harga_total,
            'supplier' => $request->supplier,
            'tanggal_masuk' => $request->tanggal_masuk,
            'image' => $request->file('image') ? $request->file('image')->store('images', 'public') : null
            ]);

            $barang = Barang::find($id_barang);
            
            if ($barang) {
                $barang->stok += $request->jumlah; // Tambah jumlah sesuai dengan input
                $barang->save(); // Simpan perubahan stok
            } else {
                return back()->withErrors(['id_barang' => 'Barang tidak ditemukan setelah penyimpanan.']);
            }

        return redirect()->route('barang_masuk.index')->with('success', 'Data pembelian barang berhasil ditambahkan');
    } 

    public function destroy($id_masuk)
    {
        $barangmasuk = Barang_Masuk::findOrFail($id_masuk);

        $id_barang = $barangmasuk->id_barang;
        $jumlah_hapus = $barangmasuk->jumlah;
    
        // Hapus data barang dari database
        $barangmasuk->delete();

        $barang = Barang::find($id_barang);
    if ($barang) {
        // Pastikan stok tidak menjadi negatif
        if ($barang->stok >= $jumlah_hapus) {
            // Kurangi stok barang
            $barang->stok -= $jumlah_hapus;
            $barang->save(); // Simpan perubahan stok
        } else {
            return back()->withErrors(['stok' => 'Stok tidak cukup untuk menghapus barang masuk.']);
        }
    }
        return redirect()->route('barang_masuk.index')->with('success', 'Data barang masuk berhasil dihapus');
    }
    
    public function edit($id_masuk) {
    $barangmasuk = Barang_Masuk::findOrFail($id_masuk);//Mengambil data barang
    $barang = Barang::all(); // Mengambil semua data barang

    return view('barang_masuk.edit', compact('barangmasuk', 'barang'));
    }

    public function update(Request $request, $id_masuk)
    {
        $request->validate([
            'id_barang' => 'required|exists:barang,id_barang',
            'jumlah' => 'required|integer',
            'harga_satuan' => 'required|numeric',
            'harga_total' => 'required|numeric',
            'supplier' => 'nullable|string|max:50',
            'tanggal_masuk' => 'required|date', // tanggal
        ]);

            $barangmasuk = Barang_Masuk::findOrFail($id_masuk);

            // Update data barang masuk
            $barangmasuk->update([
                'id_barang' => $request->id_barang,
                'jumlah' => $request->jumlah,
                'harga_satuan' => $request->harga_satuan,
                'harga_total' => $request->harga_total,
                'supplier' => $request->supplier,
                'tanggal_masuk' => $request->tanggal_masuk,
            ]);

            return redirect()->route('barang_masuk.index')->with('success', 'Data barang masuk berhasil diupdate');
        }
    }

