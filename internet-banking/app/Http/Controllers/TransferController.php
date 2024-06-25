<?php

// app/Http/Controllers/TransferController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction;

class TransferController extends Controller
{
    public function showTransferForm()
    {
        return view('transfer');
    }

    public function transfer(Request $request)
    {
        $request->validate([
            'nik' => 'required|exists:users,nik',
            'amount' => 'required|numeric|min:10000',
        ],[
            'nik.exists' => 'NIK penerima tidak ditemukan.',
            'amount.min' => 'Minimal jumlah transfer adalah Rp 10,000.',
        ]);

        $sender = Auth::user();
        $recipient = User::where('nik', $request->nik)->first();

        if (!$recipient) {
            return redirect()->route('transfer')->withErrors(['nik' => 'Penerima tidak ditemukan.']);
        }

        if ($sender->saldo < $request->amount) {
            return redirect()->route('transfer')->withErrors(['amount' => 'Saldo tidak mencukupi untuk melakukan transfer.']);
        }

        // Kurangi saldo pengirim
        $sender->saldo -= $request->amount;
        $sender->save();

        // Tambah saldo penerima
        $recipient->saldo += $request->amount;
        $recipient->save();

        // Catat transaksi untuk pengirim
        $transactionSender = new Transaction;
        $transactionSender->user_id = $sender->id;
        $transactionSender->deskripsi = 'Transfer ke ' . $recipient->nama_lengkap;
        $transactionSender->jumlah = -$request->amount;
        $transactionSender->save();

        // Catat transaksi untuk penerima
        $transactionRecipient = new Transaction;
        $transactionRecipient->user_id = $recipient->id;
        $transactionRecipient->deskripsi = 'Terima transfer dari ' . $sender->nama_lengkap;
        $transactionRecipient->jumlah = $request->amount;
        $transactionRecipient->save();

        return redirect()->route('transfer')->with('success', 'Transfer berhasil!');
    }
}
