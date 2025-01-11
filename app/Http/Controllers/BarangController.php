<?php

namespace App\Http\Controllers;

//import model product
use App\Models\Barang;

//post 
use App\Models\Post;

 //import return type View
use Illuminate\View\View;

//import class
use Illuminate\Http\Request;

//mengambil data
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Http;


class BarangController extends Controller
{
    
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request) : View
    {
        //get all products
        $barang = Barang::with('brand', 'category')->paginate(10);

        if ($request->has('q')) {
            $query = $request->get('q');
            $barang = $barang->where('name', 'like', '%' . $query . '%');
        }

        if ($request->ajax()) {
            return view('barang.data', compact('barang'));
        }
        
        //render view with products
        return view('barang.index', compact('barang'));
    }


    public function create()
    {
        //mengambil data brand dan kategori
        $brands = Brand::all();
        $categories = Category::all();

        //mengembalikan 
        return view('barang.create', compact('brands','categories'));
    }
    
    public function store(Request $request)
    {
        //Fungsi validasi
        $request->validate([
            'kode_barang' => 'required|unique:barang',
            'name' => 'required|string|max:255',
            'stok' => 'required|integer|min:1', // Pastikan stok adalah angka dan minimal 1
            'harga' => 'required|numeric|min:0', // Harga 
            'deskripsi' => 'nullable|string|max:255', // Deskripsi bersifat opsional dan berupa teks
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Validasi gambar, maksimal 10MB
            'id_merek' => 'required|exists:brands,id_merek', // Validasi merek harus ada di tabel brands
            'id_kategori' => 'required|exists:categories,id_kategori', // Validasi kategori harus ada di tabel categories
        ]);
    
        // Mendapatkan ID Barang terakhir dan menambahkannya dengan 1
        $lastBarang = Barang::orderBy('id_barang', 'desc')->first();
        $newIdBarang = $lastBarang ? 'B' . str_pad((intval(substr($lastBarang->id_barang, 1)) + 1), 3, '0', STR_PAD_LEFT) : 'B001';
    
        // Menyimpan data ke database
        Barang::create([
            'id_barang' => $newIdBarang,
            'kode_barang' => $request->kode_barang,
            'name' => $request->name,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'image' => $request->file('image') ? $request->file('image')->store('images', 'public') : null, // Menyimpan gambar jika ada
            'id_merek' => $request->id_merek,
            'id_kategori' => $request->id_kategori,
            ]);
    
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    } 

    public function destroy($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
    
        // Hapus gambar dari penyimpanan jika ada
        if ($barang->image && \Storage::disk('public')->exists($barang->image)) {
            \Storage::disk('public')->delete($barang->image);
        }
    
        // Hapus data barang dari database
        $barang->delete();
    
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
    
    public function edit($id_barang) {
    $barang = Barang::findOrFail($id_barang);//Mengambil data barang
    $brands = Brand::all(); // Mengambil semua data merek
    $categories = Category::all(); // Mengambil semua data kategori

    return view('barang.edit', compact('barang', 'brands', 'categories'));
    }

    public function update(Request $request, $id_barang)
    {
        $request->validate([
            'kode_barang' => 'required|string',
            'name' => 'required|string|max:255',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|max:10240', // batasan maksimal 10MB untuk gambar
            'id_merek' => 'required|exists:brands,id_merek',
            'id_kategori' => 'required|exists:categories,id_kategori',
        ]);

            $barang = Barang::findOrFail($id_barang);

            // Cek dan perbarui gambar jika ada upload baru
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($barang->image && \Storage::disk('public')->exists($barang->image)) {
                    \Storage::disk('public')->delete($barang->image);
                }
                
                // Simpan gambar baru
                $imagePath = $request->file('image')->store('images', 'public');
                $barang->image = $imagePath;
            }

            // Update data barang
            $barang->update([
                'kode_barang' => $request->kode_barang,
                'name' => $request->name,
                'stok' => $request->stok,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
                'id_merek' => $request->id_merek,
                'id_kategori' => $request->id_kategori,
            ]);

            return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate');
        }

        // Mengecek stok barang
        public function cekStok()
        {
            // Menggunakan stok_barang untuk query yang benar
            $stokHampirHabis = Barang::where('stok', '<', 2)->get();
        
            foreach ($stokHampirHabis as $barang) {
                $this->sendWhatsApp($barang);
            }
        }


        public function searchBarang(Request $request)
        {
            $term = $request->get('term'); // Ambil kata kunci pencarian
        
            $barang = Barang::with(['brand', 'category']) // Eager load relasi 'brand' dan 'category'
                            ->where('name', 'LIKE', '%' . $term . '%')
                            ->get(['id_barang', 'kode_barang', 'name', 'stok', 'harga', 'deskripsi', 'image', 'id_merek', 'id_kategori']);
        
            // Menambahkan brand_name dan category_name ke setiap barang
            $barang->each(function ($item) {
                $item->brand_name = $item->brand ? $item->brand->title : 'Tidak ada brand'; // Mengakses nama brand
                $item->category_name = $item->category ? $item->category->name : 'Tidak ada kategori'; // Mengakses nama kategori
            });
        
            return response()->json($barang); // Kirim data dalam format JSON
        }
        
        
    

        public function sendWhatsApp($barang){
            $apiKey = "8hXKQNriVWumc4ogJNZp"; // API key Fonnte
            $nomorTarget = "6281253413067"; // Nomor WhatsApp tujuan
        
            // Memastikan penggunaan nama kolom yang tepat
            $pesan = "🚨 Stok Barang Menipis 🚨\n\n" .
                    "- Nama Barang: {$barang->name}\n" .
                    "- Stok Tersisa: {$barang->stok}\n\n" .
                    "❗ Harap segera melakukan pemesanan ulang untuk menghindari kekosongan stok.";

        
            // Mengirim request ke API Fonnte untuk mengirimkan WhatsApp
            $response = Http::withHeaders([
                'Authorization' => $apiKey
            ])->post('https://api.fonnte.com/send', [
                'target' => $nomorTarget,
                'message' => $pesan,
                'countryCode' => '62',
            ]);
        
            // Menangani hasil response dari API
            if ($response->successful()) {
                echo "Notifikasi berhasil dikirim untuk barang {$barang->name}.\n";
            } else {
                // Menampilkan pesan error jika gagal mengirim
                $errorMessage = $response->json()['message'] ?? 'Tidak ada pesan error.';
                echo "Gagal mengirim notifikasi untuk barang {$barang->name}. Error: {$errorMessage}\n";
            }
        }
        
}