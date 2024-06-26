<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;

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
            'pin' => 'required'
        ], [
            'amount.min' => 'Minimal saldo yang dapat ditambahkan adalah Rp 10,000.',
            'pin.required' => 'PIN harus diisi.'
        ]);

        $user = Auth::user();

        // Verifikasi PIN
        if (!Hash::check($request->pin, $user->pin)) {
            return redirect()->route('saldo')->withErrors(['pin' => 'PIN yang Anda masukkan salah.']);
        }

        $user->saldo += $request->amount;
        $user->save();

        // Simpan transaksi
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->deskripsi = 'Penambahan saldo';
        $transaction->jumlah = $request->amount;
        $transaction->save();

        return redirect()->route('saldo')->with('success', 'Saldo berhasil ditambahkan!');
    }
}
