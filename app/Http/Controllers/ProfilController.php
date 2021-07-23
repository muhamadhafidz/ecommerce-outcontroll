<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        // $data = Auth::user();
        $data = User::findOrFail(Auth::user()->id);
        return view('admin.pages.profil.index', [
            'data' => $data
        ]);
    }

    public function edit()
    {
        // $data = Auth::user();
        $data = User::findOrFail(Auth::user()->id);
        return view('admin.pages.profil.edit', [
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {
        // $data = Auth::user();
        $item = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email'
        ]);
        $data = User::findOrFail(Auth::user()->id);
        $data->update([
            'name' => $item['name'],
            'email' => $item['email']
        ]);
        return redirect()->route('admin.profil-index');
    }

    public function updatePassword(Request $request)
    {
        $item = $request->validate([
            'password_old' => 'required|min:8|max:16',
            'password_new' => 'required|min:8|max:16',
            'password_confirm' => 'required',
        ]);

        $activeUser = Auth::user();
        if ($item['password_new'] == $item['password_confirm']) {
            if (Hash::check($item['password_old'],$activeUser->password)) {
                $activeUser->update([
                    'password' => Hash::make($item['password_new']),
                ]);
                Alert::success('Password berhasil diubah', '');
            }else {
                Alert::error('Gagal merubah password', 'password lama yang anda masukan salah');
            }
        }else {
            Alert::error('Gagal merubah password', 'konfirmasi password tidak cocok');
        }
        
        return redirect()->route('admin.profil-index');
    }
}
