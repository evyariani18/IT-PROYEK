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

        Brand::create([
            'title' => $request->title,
        ]);

        return redirect()->route('brands.index')->with('success', 'Merek berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $brands = Brand::findOrFail($id);
        $brands->delete();

        return redirect()->route('brands.index')->with('success', 'Merek berhasil dihapus');
    }

    public function edit($id)
    {
        $brands = Brand::findOrFail($id);
        return view('brands.edit', compact('brands'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $brands = Brand::findOrFail($id);
        $brands->update([
            'title' => $request->title,
        ]);
        $brands->save();


        return redirect()->route('brands.index')->with('success', 'Merek berhasil diupdate');
    }
}

