<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'BANKID' => 'required|string|max:255|unique:users',
            'nik' => 'required|string|size:16|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        // Create the user with validated data and generate a new account number
        $user = User::create([
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'BANKID' => $validatedData['BANKID'],
            'nik' => $validatedData['nik'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'account_number' => $this->generateAccountNumber(),
        ]);

        // Set account number in session flash
        session()->flash('account_number', $user->account_number);

        // Login the user
        Auth::login($user);

        // Redirect to set PIN view
        return redirect()->route('set.pin');
    }


    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('BANKID', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Check if the user already has a PIN
            if (!$user->pin) {
                return redirect()->route('set.pin');
            }
            
            return redirect()->route('home');
        }

        return back()->withErrors([
            'BANKID' => 'BANKID atau password salah.',
        ]);
    }

    public function showSetPinForm()
    {
        return view('auth.set-pin');
    }

    public function setPin(Request $request)
    {
        $validatedData = $request->validate([
            'pin' => 'required|digits:6|confirmed',
        ]);

        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        
        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus login untuk mengatur PIN.']);
        }

        $user->pin = Hash::make($validatedData['pin']);
        $user->save();

        // Logout user after setting PIN
        Auth::logout();

        return redirect()->route('login')->with('success_message', 'PIN Anda berhasil dibuat. Silahkan login untuk melanjutkan.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome');
    }

    private function generateAccountNumber()
    {
        return mt_rand(1000000000, 9999999999); // Generate a 10-digit random number
    }

    public function validatePin(Request $request)
{
    $user = Auth::user();
    $pin = $request->input('pin');

    if (Hash::check($pin, $user->pin)) { // Pastikan hash pin di database
        return response()->json(['valid' => true]);
    } else {
        return response()->json(['valid' => false]);
    }
}

}
