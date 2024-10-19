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

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus');
    }

    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        return view('categories.edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categories = Category::findOrFail($id);
        $categories->update([
            'name' => $request->name,
        ]);
        $categories->save();


        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui');
    }
}


