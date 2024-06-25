<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function transfer()
    {
        return view('transfer');
    }

    public function transactions()
    {
        return view('transactions');
    }

    public function home()
    {
        return view('home');
    }
}


