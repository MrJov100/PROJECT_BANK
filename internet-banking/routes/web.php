<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\MutasiRekeningController;
use App\Http\Controllers\SaldoController;

// Welcome route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Registration routes
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Login routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// Logout route
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Home route
Route::get('home', function() {
    return view('home');
})->middleware('auth')->name('home');

// Rute untuk menampilkan form tambah saldo
Route::get('/saldo', [SaldoController::class, 'showSaldoForm'])->name('saldo');

// Rute untuk menangani permintaan tambah saldo
Route::post('/add-saldo', [SaldoController::class, 'addSaldo'])->name('add-saldo');

// Rute untuk menampilkan mutasi rekening
Route::get('mutasi-rekening', [MutasiRekeningController::class, 'index'])->middleware('auth')->name('mutasi-rekening');

// Rute untuk memvalidasi PIN
Route::post('/validate-pin', [AuthController::class, 'validatePin'])->name('validate-pin');

Route::get('transfer', [TransferController::class, 'showTransferForm'])->middleware('auth')->name('transfer');
Route::post('transfer', [TransferController::class, 'transfer'])->middleware('auth')->name('transfer.post');

Route::get('set-pin', [AuthController::class, 'showSetPinForm'])->name('set.pin');
Route::post('set-pin', [AuthController::class, 'setPin']);
