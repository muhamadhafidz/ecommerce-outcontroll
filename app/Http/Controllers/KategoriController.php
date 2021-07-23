<?php

namespace App\Http\Controllers;

use App\Category;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index()
    {
        $data = Category::get();
        return view('admin.pages.kategori.index', [
             'data' => $data
        ]);
    }

    public function create()
    {
        return view('admin.pages.kategori.create');
    }

    public function store(Request $request )
    {
        $kategori = $request->validate([
            'name' => 'required|unique:categories,name'
        ]);
        
        $kategori['slug'] = Str::slug($kategori['name'], '-');
        Category::create($kategori);

        return redirect()->route('admin.kategori');
    }

    public function edit($id)
    {
        $item = Category::findOrFail($id);
        return view('admin.pages.kategori.edit',[
            'item' => $item
        ]);
    }

    public function update(Request $request, $id )
    {
        $kategori = $request->validate([
            'name' => 'required|unique:categories,name,'.$id
        ]);
        
        $kategori['slug'] = Str::slug($kategori['name'], '-');
        Category::findOrFail($id)->update($kategori);

        return redirect()->route('admin.kategori');
    }

    public function delete(Request $request, $id )
    {
        // $kategori = $request->validate([
        //     'name' => 'required|unique:categories,name,'.$id
        // ]);
        
        // $kategori['slug'] = Str::slug($kategori['name'], '-');
        Category::findOrFail($id)->delete();

        return redirect()->route('admin.kategori');
    }
}
