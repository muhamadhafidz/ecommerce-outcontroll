<?php

namespace App\Http\Controllers\user;

use App\Cart;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Product_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index()
    {
        $data = Product::with(['detail' => function ($q){

            $q->orderBy('price', 'asc');

        }, 'images'])->where('active', 'y')->orderBy('id', 'desc')->get();

        $category = Category::all();
        return view('user.pages.produk.index', [
            'data' => $data,
            'category' => $category
        ]);
    }

    public function detail($slug)
    {
        $data = Product::with(['detail' => function($q){
            $q->where('stock', '>', '0');
        }, 'images'])->where('active', 'y')->where('slug', $slug)->firstOrFail();
        // dd($data);
        $produk = Product::with(['detail' => function ($q){

            $q->orderBy('price', 'asc');

        }, 'images'])->where('active', 'y')->where('category_id', $data->category_id)->orderBy('id', 'desc')->get();

        return view('user.pages.produk.detail', [
            'data' => $data,
            'produk' => $produk
        ]);
    }
    public function addProduct(Request $request, $id)
    {
        Product::where('active', 'y')->findOrFail($id);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['product_id'] = $id;
        // dd($data);
        Cart::create($data);
        $detail = Product_detail::find($data['detail_id']);
        
        $detail->update([
            'stock' => $detail->stock - 1
        ]);
        return redirect()->route('user.keranjang');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $data = Product::with(['detail' => function ($q){

            $q->orderBy('price', 'asc');

        }, 'images'])->where('active', 'y')->where('name', 'like', "%$search%")->orderBy('id', 'desc')->get();
        // dd($data);
        $category = Category::all();
        return view('user.pages.produk.index', [
            'data' => $data,
            'category' => $category
        ]);    
    }

    public function category($key)
    {
        $data = Category::where('slug', $key)->first()->product()->with(['detail' => function ($q){

            $q->orderBy('price', 'asc');

        }, 'images'])->where('active', 'y')->orderBy('id', 'desc')->get();
        // dd($data);
        $category = Category::all();
        return view('user.pages.produk.index', [
            'data' => $data,
            'category' => $category
        ]);    
    }
}
