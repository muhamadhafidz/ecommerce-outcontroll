<?php

namespace App\Http\Controllers;

use App\Resi;
use App\Transaction;
use App\Transaction_product;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $data = Transaction::with(['transaction_product', 'user'] )->get();
        return view('admin.pages.pesanan.index', [
             'data' => $data
        ]);
    }

    public function konfirmasi()
    {
        $data = Transaction::with(['bukti', 'user'])->where('status', 'menunggu konfirmasi')->get();
        return view('admin.pages.pesanan.konfirmasi', [
             'data' => $data
        ]);
    }
    public function kirim()
    {
        $data = Transaction::with(['resi', 'user'])->where('status', 'dikirim')->get();
        return view('admin.pages.pesanan.kirim', [
             'data' => $data
        ]);
    }
    public function selesai()
    {
        $data = Transaction::with(['resi', 'user'])->where('status', 'selesai')->get();
        return view('admin.pages.pesanan.selesai', [
             'data' => $data
        ]);
    }
    public function resi($id)
    {
        $data = Transaction::findOrFail($id);
        if ($data->status != "diproses") {
            return redirect()->route('admin.pesanan');
        }
        return view('admin.pages.pesanan.resi',[
            'id' => $id
        ]);
    }
    public function valid(Request $request, $id )
    {
        // $pesanan = $request->validate([
        //     'name' => 'required|unique:categories,name,'.$id
        // ]);
        
        Transaction::findOrFail($id)->update([
            'status' => 'diproses'
        ]);

        return redirect()->route('admin.pesanan-konfirmasi');
    }
    public function sampai(Request $request, $id )
    {
        // $pesanan = $request->validate([
        //     'name' => 'required|unique:categories,name,'.$id
        // ]);
        
        Transaction::findOrFail($id)->update([
            'status' => 'selesai'
        ]);

        return redirect()->route('admin.pesanan-kirim');
    }
    public function addResi(Request $request, $id )
    {
        $item = $request->validate([
            'resi' => 'required'
        ]);
        Resi::create([
            'transaction_id' => $id,
            'resi' => $item['resi']
        ]);
        Transaction::findOrFail($id)->update([
            'status' => 'dikirim'
        ]);

        return redirect()->route('admin.pesanan-proses');
    }
    public function proses()
    {
        $data = Transaction::with(['transaction_product.product.images', 'user'] )->where('status', 'diproses')->get();
        return view('admin.pages.pesanan.proses', [
             'data' => $data
        ]);
    }
}
