<?php

namespace App\Http\Controllers\user;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $all = Product::with(['detail' => function ($q){

            $q->orderBy('price', 'asc');

        }, 'images'])->where('active', 'y')->orderBy('id', 'desc')->get();
        $laris = Product::with(['detail' => function ($q){

            $q->orderBy('price', 'asc');

        }, 'images'])->where('active', 'y')->orderBy('sold', 'desc')->take(5)->get();
        $data = Category::with(['product' => function ($q){

            $q->where('active', 'y')->orderBy('id', 'desc');

        }, 'product.detail' => function ($q){

                $q->orderBy('price', 'asc');
    
        }, 'product.images'])->get();

        
        return view('user.pages.home.index',[
            'data' => $data,
            'all' => $all,
            'laris' => $laris
        ]);
        
    }
}
