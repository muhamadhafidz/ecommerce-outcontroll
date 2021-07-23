<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Product_detail;
use App\Product_image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
Use File;
class ProdukController extends Controller
{
    public function index()
    {
        $data = Product::with(['category', 'detail', 'images'])->get();
        return view('admin.pages.produk.index', [
             'data' => $data
        ]);
    }

    public function create()
    {
        $data = Category::get();
        return view('admin.pages.produk.create', [
            'data' => $data
        ]);
    }

    public function store(Request $request )
    {
        
        $product = $request->validate([
            'name' => 'required|max:30|unique:products,name',
            'category' => 'required|integer',
            'description' => 'required',
            'active' => ''
        ]);
        $image = $request->validate([
            'image1' => 'required|max:2048|image|mimes:jpeg,jpg,png',
            'image2' => 'required|max:2048|image|mimes:jpeg,jpg,png',
            'image3' => 'required|max:2048|image|mimes:jpeg,jpg,png',
        ]);
        $details = $request->validate([
            'size.*' => 'required|max:3',
            'stock.*' => 'required|integer',
            'price.*' => 'required|integer',
        ]);
        if (!isset($product['active'])) {
            $product['active'] = 't';
        }
        $product['sold'] = 0;
        // dd($product);
        $product['slug'] = Str::slug($product['name'], '-');
        $product['category_id'] = $product['category'];
        $productId = Product::create($product)->id;
        $image['product_id'] = $productId;
        for ( $i = 1 ; $i <= 3 ; $i++) {
            $file = $request->file('image'.$i);
            if (isset($file)) {
                $file_name = $product['slug']."-img-".$i.".".$file->getClientOriginalExtension();
                $file_location = "assets/admin/img/products";
                $stored_file = $file->move($file_location, $file_name);
                $image['dir_photo'] = $stored_file->getPathname();
                $image['number'] = $i;
                Product_image::create($image);
            }
            
        }
        // dd($detail);
        $dtl = [];
        $i = 1;
        foreach ($details['size'] as $size) {
            $dtl['product_id'] = $productId;
            $dtl['size'] = $details['size'][$i];
            $dtl['stock'] = $details['stock'][$i];
            $dtl['price'] = $details['price'][$i];
            Product_detail::create($dtl);
            $i++;
        }
        // dd("a");
        return redirect()->route('admin.produk');
    }

    public function getDetail(Request $request)
    {
        $result = '';
        // $id_asisten = [];
        $details = Product_detail::where('product_id', $request->id_product)->get();
        // foreach ($jadwal->asisten as $jdwl) {
        //     $id_asisten[] = $jdwl->user_id;
        // }
        
        foreach ($details as $detail) {
            $result .= '<tr>';
            $result .= '<td>'.$detail->size.'</td>';
            $result .= '<td>'.$detail->stock.'</td>';
            $result .= '<td> Rp. '.$detail->price.'</td>';
            $result .= '</tr>';
        }
        return response()->json($result);
    }

    public function setStatus(Request $request)
    {
        $result = '';
        // $id_asisten = [];
        $details = Product::findOrFail($request->id_product);
        if ($details->status == "y") {
            $status = "t";
        }else {
            $status = "y";
        }
        $result = $details->update([
            'active' => $status
        ]);
        
        return response()->json($result);
    }

    public function edit($id)
    {
        $categories = Category::get();
        $item = Product::with(['category', 'detail', 'images'])->findOrFail($id);

        
        return view('admin.pages.produk.edit', [
            'item' => $item,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id )
    {
        
        $product = $request->validate([
            'name' => 'required|max:30|unique:products,name,'.$id,
            'category' => 'required',
            'description' => 'required',
            'active' => ''
        ]);
        $image = $request->validate([
            'image1' => 'max:2048|image|mimes:jpeg,jpg,png',
            'image2' => 'max:2048|image|mimes:jpeg,jpg,png',
            'image3' => 'max:2048|image|mimes:jpeg,jpg,png',
        ]);
        $details = $request->validate([
            'size.*' => 'required|max:3',
            'stock.*' => 'required|integer',
            'price.*' => 'required|integer',
        ]);
        if (!isset($product['active'])) {
            $product['active'] = 't';
        }

        $product['slug'] = Str::slug($product['name'], '-');
        $product['category_id'] = $product['category'];

        Product::findOrFail($id)->update($product);

        $dataImage = Product_image::where('product_id',$id)->get();
        
        $image['product_id'] = $id;
        for ( $i = 1 ; $i <= 3 ; $i++) {
            $file = $request->file('image'.$i);
            if (isset($file)) {
                File::delete($dataImage[$i-1]->dir_photo);
                $file_name = $product['slug']."-img-".$i.".".$file->getClientOriginalExtension();
                $file_location = "assets/admin/img/products";
                $stored_file = $file->move($file_location, $file_name);
                $image['dir_photo'] = $stored_file->getPathname();

                $dataImage[$i-1]->update($image);
            }
            
        }
        // dd($detail);
        $dtl = [];
        $i = 1;
        $dataSize = Product_detail::where('product_id', $id)->delete();
        // $dataSize;
        foreach ($details['size'] as $size) {
            $dtl['product_id'] = $id;
            $dtl['size'] = $details['size'][$i];
            $dtl['stock'] = $details['stock'][$i];
            $dtl['price'] = $details['price'][$i];
            Product_detail::create($dtl);
            $i++;
        }

        return redirect()->route('admin.produk');
    }

    public function delete(Request $request, $id )
    {
        // $kategori = $request->validate([
        //     'name' => 'required|unique:categories,name,'.$id
        // ]);
        
        // $kategori['slug'] = Str::slug($kategori['name'], '-');
        $item = Product::with('images')->findOrFail($id);
        File::delete($item->images[0]->dir_photo);
        File::delete($item->images[1]->dir_photo);
        File::delete($item->images[2]->dir_photo);
        $item->delete();
        return redirect()->route('admin.produk');
    }
}
