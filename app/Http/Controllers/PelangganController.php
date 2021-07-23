<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $data = User::with('transaction')->where('roles', 'user')->get();
        return view('admin.pages.pelanggan.index', [
            'data' => $data
       ]);
    }

    public function delete(Request $request, $id )
    {

        $item = User::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.pelanggan');
    }
}
