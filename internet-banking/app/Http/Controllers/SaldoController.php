<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaldoController extends Controller
{
    public function showSaldoForm()
    {
        return view('saldo');
    }

    public function addSaldo(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
        ], [
            'amount.min' => 'Minimal saldo yang dapat ditambahkan adalah Rp 10,000.'
        ]);

        $user = Auth::user();
        $user->saldo += $request->amount;
        $user->save();

        return redirect()->route('saldo')->with('success', 'Saldo berhasil ditambahkan!');
    }
}
