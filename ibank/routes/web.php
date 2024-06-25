<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'home'])->name('home');



Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
Route::get('/transfer', [UserController::class, 'transfer'])->name('transfer');
Route::get('/transactions', [UserController::class, 'transactions'])->name('transactions');
