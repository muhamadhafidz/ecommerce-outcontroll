<?php

namespace App\Http\Controllers\user;

use App\Bukti;
use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        $data = Transaction::with(['transaction_product.product', 'resi', 'bukti'])->where('user_id', Auth::user()->id)->get();
        return view('user.pages.pesanan.index', [
            'data' => $data
        ]);
    }
    public function show($id)
    {
        $data = Transaction::where('user_id', Auth::user()->id)->findOrFail($id);
        return view('user.pages.pesanan.show', [
            'data' => $data
        ]);
    }

    public function bukti(Request $request, $id)
    {
        $item = $request->validate([
            'bukti' => 'required|image|max:2048'
        ]);
        
        $file = $request->file('bukti');
        $file_name = "bukti-".Auth::user()->id.".".$file->getClientOriginalExtension();
        $file_location = "assets/admin/img/bukti";
        $stored_file = $file->move($file_location, $file_name);
        $item['dir_payment_pic'] = $stored_file->getPathname();
        $item['transaction_id'] = $id;
        Bukti::create($item);
        Transaction::findOrFail($id)->update([
            'status' => 'menunggu konfirmasi'
        ]);
        return redirect()->route('user.pesanan');
    }
}
