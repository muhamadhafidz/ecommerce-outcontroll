<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::where('roles', 'user')->count();
        $transaction_confirm = Transaction::where('status', 'menunggu konfirmasi')->count();
        $transaction_success = Transaction::where('status', 'selesai')->count();
        $transaction_money = Transaction::where('status', 'selesai')->sum('total_price');
        return view('admin.pages.dashboard.index', [
            'user' => $user,
            'transaction_success' => $transaction_success,
            'transaction_money' => $transaction_money,
            'transaction_confirm' => $transaction_confirm,
        ]);
    }
}
