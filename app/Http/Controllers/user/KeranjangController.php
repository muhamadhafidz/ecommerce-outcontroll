<?php

namespace App\Http\Controllers\user;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Product;
use App\Transaction;
use App\Transaction_product;
use App\User;
use App\User_address;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Support\Collection;

class KeranjangController extends Controller
{
    public function index()
    {
        $data = Cart::with(['product.images', 'detail'])->where('user_id', Auth::user()->id)->get();
        $provinsi = RajaOngkir::provinsi()->all();
        
        if (!Auth::user()->address()->get()->isEmpty()) {
            # code...
            $kota = RajaOngkir::kota()->dariProvinsi(Auth::user()->address()->first()->provinsi_id)->get();
            // dd($kota);
        }else {
            $kota = collect([]);
        }
        // $a = User::get();
        // dd($a);

        return view('user.pages.keranjang.index', [
            'data' => $data,
            'provinsi' => $provinsi,
            'kota' => $kota
        ]);
    }
    
    public function checkout($id)
    {
        
    }

    public function getKota(Request $request)
    {
        $result = "";
        $id = $request->province_id;
        
        $kota = RajaOngkir::kota()->dariProvinsi($id)->get();
        // dd($kota);
        $result .= '<option >-- Pilih Kota/Kab --</option>';
        foreach ($kota as $kt) {
            $result .= '<option value="'.$kt['city_id'].'">'.$kt['type']." ".$kt['city_name'].'</option>';
        }
        return response()->json($result);
    }

    public function getOngkir(Request $request)
    {
        // $result = "";
        $id = $request->city_id;
        
        $ongkir = RajaOngkir::ongkosKirim([
            'origin'        => 455,     // ID kota/kabupaten asal
            'destination'   => $id,      // ID kota/kabupaten tujuan
            'weight'        => 1300,    // berat barang dalam gram
            'courier'       => 'jne'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();
        // dd($ongkir[0]['costs'][1]['cost'][0]['value']);
        // $result = $ongkir[]
        return response()->json($ongkir[0]['costs'][1]['cost'][0]);
    }

    public function addQty(Request $request)
    {
        // $result = "";
        $qty = $request->qty;
        $id = $request->id;
        // dd($qty);
        Cart::findOrFail($id)->update([
            'qty' => $qty,
        ]);
        return response()->json("sukses");
    }

    public function addTransaction(Request $request)
    {
        $name = $request->validate(['name' => 'required']);
        
        $address = $request->validate([
            'no_telp' => 'required',
            'address' => 'required',
            'provinsi_id' => 'required',
            'kota_id' => 'required',
            'post_code' => 'required'
        ]);
        Auth::user()->update($name);
        $address['user_id'] = Auth::user()->id;
        $usAd = User_address::where('user_id', Auth::user()->id)->first();
        $cart = Cart::with(['product', 'detail'])->where('user_id', Auth::user()->id)->get();
        if (isset($usAd)) {
            // dd("waw");
            $usAd->update($address);
        }else {

            User_address::create($address);
        }

        $provinsi = RajaOngkir::provinsi()->find($address['provinsi_id']);
        $kota = RajaOngkir::kota()->find($address['kota_id']);
        $transaction['user_id'] = Auth::user()->id;
        $transaction['name_user'] = User::find(Auth::user()->id)->name;
        $transaction['address'] = $address['address']. " - ".$kota['type']." ".$kota['city_name'].", Provinsi ".$provinsi['province'];
        $transaction['status'] = 'menunggu pembayaran';
        $transaction['ongkir_price'] = 0;
        foreach ($cart as $crt) {
            $transaction['total_price'] = $crt->detail->price * $crt->qty;
        }

        $ongkir = RajaOngkir::ongkosKirim([
            'origin'        => 455,     // ID kota/kabupaten asal
            'destination'   => $address['kota_id'],      // ID kota/kabupaten tujuan
            'weight'        => 1300,    // berat barang dalam gram
            'courier'       => 'jne'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();
        $transaction['ongkir_price'] = $ongkir[0]['costs'][1]['cost'][0]['value'];
        $idTrs = Transaction::create($transaction)->id;

        $tProduct['transaction_id'] = $idTrs;
        foreach ($cart as $crt) {
            $crt->detail->update(['stock' => ( $crt->detail->stock - $crt->qty )]);
            $tProduct['qty'] = $crt->qty;
            $tProduct['price'] = $crt->detail->price;
            $tProduct['size'] = $crt->detail->size;
            $tProduct['product_name'] = $crt->product->name;
            Transaction_product::create($tProduct);
        }

        Cart::where('user_id', Auth::user()->id)->delete();
        // dd($tProduct);
        return redirect()->route('user.pesanan-show',[
            'id' => $idTrs
        ]);
    }

    public function delete(Request $request, $id)
    {
        Cart::findOrFail($id)->delete();
        return redirect()->route('user.keranjang');
    }
}
