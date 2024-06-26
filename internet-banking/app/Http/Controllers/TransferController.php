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
        // Fetch users who have transactions (example)
    $users = User::where('id', '!=', auth()->id())->get(); // Exclude current authenticated user
    return view('transfer', compact('users'));
    }

    public function transfer(Request $request)
    {
        $request->validate([
            'account_number' => 'required|exists:users,account_number',
            'amount' => 'required|numeric|min:10000',
        ],[
            'account_number.exists' => 'Rekening penerima tidak ditemukan.',
            'amount.min' => 'Minimal jumlah transfer adalah Rp 10,000.',
        ]);

        $sender = Auth::user();
        $recipient = User::where('account_number', $request->account_number)->first();

        if (!$recipient) {
            return redirect()->route('transfer')->withErrors(['account_number' => 'Penerima tidak ditemukan.']);
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
