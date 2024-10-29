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


class BarangController extends Controller
{
    
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all products
        $barangs = Barang::with('brand', 'category')->paginate(10);
        
        //render view with products
        return view('barangs.index', compact('barangs'));
    }


    public function create()
    {
        //mengambil data brand dan kategori
        $brands = Brand::all();
        $categories = Category::all();

        //mengembalikan 
        return view('barangs.create', compact('brands','categories'));
    }
    
    public function store(Request $request)
    {
        //Fungsi validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'stok' => 'required|integer|min:1', // Pastikan stok adalah angka dan minimal 1
            'harga' => 'required|numeric|min:0', // Harga 
            'deskripsi' => 'nullable|string|max:255', // Deskripsi bersifat opsional dan berupa teks
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Validasi gambar, maksimal 10MB
            'id_merek' => 'required|exists:brands,id_merek', // Validasi merek harus ada di tabel brands
            'id_kategori' => 'required|exists:categories,id_kategori', // Validasi kategori harus ada di tabel categories
        ]);

         // Log data yang diterima dari permintaan
            \Log::info($request->all());
    
        // Mendapatkan ID Barang terakhir dan menambahkannya dengan 1
        $lastBarang = Barang::orderBy('id_barang', 'desc')->first();
        $newIdBarang = $lastBarang ? 'B' . str_pad((intval(substr($lastBarang->id_barang, 1)) + 1), 3, '0', STR_PAD_LEFT) : 'B001';
    
        // Menyimpan data ke database
        Barang::create([
            'id_barang' => $newIdBarang,
            'name' => $request->name,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'image' => $request->file('image') ? $request->file('image')->store('images', 'public') : null, // Menyimpan gambar jika ada
            'id_merek' => $request->id_merek,
            'id_kategori' => $request->id_kategori,
            ]);
    
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil ditambahkan');
    } 

    public function destroy($id_barang)
    {
        $barangs = Barang::findOrFail($id_barang);
    
        // Hapus gambar dari penyimpanan jika ada
        if ($barangs->image && \Storage::disk('public')->exists($barangs->image)) {
            \Storage::disk('public')->delete($barangs->image);
        }
    
        // Hapus data barang dari database
        $barangs->delete();
    
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil dihapus');
    }
    
    public function edit($id_barang) {
    $barangs = Barang::findOrFail($id_barang);//Mengambil data barang
    $brands = Brand::all(); // Mengambil semua data merek
    $categories = Category::all(); // Mengambil semua data kategori

    return view('barangs.edit', compact('barangs', 'brands', 'categories'));
    }

    public function update(Request $request, $id_barang)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|max:10240', // batasan maksimal 10MB untuk gambar
            'id_merek' => 'required|exists:brands,id_merek',
            'id_kategori' => 'required|exists:categories,id_kategori',
        ]);

            $barangs = Barang::findOrFail($id_barang);

            // Cek dan perbarui gambar jika ada upload baru
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($barangs->image && \Storage::disk('public')->exists($barangs->image)) {
                    \Storage::disk('public')->delete($barangs->image);
                }
                
                // Simpan gambar baru
                $imagePath = $request->file('image')->store('images', 'public');
                $barangs->image = $imagePath;
            }

            // Update data barang
            $barangs->update([
                'name' => $request->name,
                'stok' => $request->stok,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
                'id_merek' => $request->id_merek,
                'id_kategori' => $request->id_kategori,
            ]);

            return redirect()->route('barangs.index')->with('success', 'Barang berhasil diupdate');
        }
    }