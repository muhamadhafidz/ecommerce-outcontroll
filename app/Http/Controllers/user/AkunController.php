<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\User_address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class AkunController extends Controller
{
    public function index()
    {
        // $data = Cart::with(['product.images', 'detail'])->where('user_id', Auth::user()->id)->get();
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

        return view('user.pages.akun.index', [
            // 'data' => $data,
            'provinsi' => $provinsi,
            'kota' => $kota
        ]);
    }
    public function update(Request $request)
    {
        // dd('waw');
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
        if (isset($usAd)) {
            // dd("waw");
            $usAd->update($address);
        }else {

            User_address::create($address);
        }
        // dd($tProduct);
        return redirect()->route('user.akun');
    }
}
