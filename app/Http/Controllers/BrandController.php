<?php

namespace App\Http\Controllers;

//import model product
use App\Models\Brand;

//post 
use App\Models\Post;

 //import return type View
use Illuminate\View\View;

//import class
use Illuminate\Http\Request;

class BrandController extends Controller
{


    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all products
        $brands = Brand::latest()->paginate(10);

        //render view with products
        return view('brands.index', compact('brands'));
    }

    public function create()
    {
        return view('brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        //Inputan merek terakhir
        $lastBrand = Brand::OrderBy('id_merek', 'desc')->first();
        $newIdMerek = $lastBrand ? 'M' . str_pad((intval(substr($lastBrand->id_merek, 1)) + 1), 3, '0', STR_PAD_LEFT) : 'M001';


        // Menyimpan ke database

        Brand::create([
            'id_merek' => $newIdMerek, // Menetapkan ID yang baru dibuat
            'title' => $request->title,
            
        ]);

        return redirect()->route('brands.index')->with('success', 'Merek berhasil ditambahkan');
    }

    public function destroy($id_merek)
    {
        $brands = Brand::findOrFail($id_merek);
        $brands->delete();

        return redirect()->route('brands.index')->with('success', 'Merek berhasil dihapus');
    }

    public function edit($id_merek)
    {
        $brands = Brand::findOrFail($id_merek);
        return view('brands.edit', compact('brands'));
    }

    public function update(Request $request, $id_merek)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $brands = Brand::findOrFail($id_merek);
        $brands->update([
            'title' => $request->title,
        ]);
        $brands->save();


        return redirect()->route('brands.index')->with('success', 'Merek berhasil diupdate');
    }
}

