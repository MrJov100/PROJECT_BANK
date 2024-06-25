<?php

// app/Http/Controllers/MutasiRekeningController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MutasiRekeningController extends Controller
{
    public function index()
    {
        // Ambil data transaksi dari user terkait
        $transactions = Auth::user()->transactions()->orderBy('created_at', 'desc')->get();

        return view('mutasi-rekening', [
            'transactions' => $transactions
        ]);
    }
}
