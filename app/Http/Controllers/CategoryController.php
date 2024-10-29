<?php

namespace App\Http\Controllers;

//import model product
use App\Models\Category;

//post 
use App\Models\Post;

 //import return type View
use Illuminate\View\View;

//import class
use Illuminate\Http\Request;

class CategoryController extends Controller{
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all products
        $categories = Category::latest()->paginate(10);

        //render view with products
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $lastCategory = Category::OrderBy('id_kategori', 'desc')->first();
        $newIdKategori = $lastCategory ? 'K' . str_pad((intval(substr($lastCategory->id_kategori, 1)) + 1), 3, '0', STR_PAD_LEFT) : 'K001';


        // Menyimpan ke database


        Category::create([
            'id_kategori' => $newIdKategori, // Menetapkan ID yang baru dibuat
            'name' => $request->name,
            
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function destroy($id_kategori)
    {
        $categories = Category::findOrFail($id_kategori);
        $categories->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus');
    }

    public function edit($id_kategori)
    {
        $categories = Category::findOrFail($id_kategori);
        return view('categories.edit', compact('categories'));
    }

    public function update(Request $request, $id_kategori)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categories = Category::findOrFail($id_kategori);
        $categories->update([
            'name' => $request->name,
        ]);
        $categories->save();


        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui');
    }
}


