<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani permintaan login
    public function login(Request $request)
    {
        // Validasi data login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Mencoba untuk login pengguna
        if (Auth::attempt($credentials)) {
            // Jika login berhasil, arahkan ke halaman yang dimaksud
            return redirect()->intended('dashboard');
        }

        // Jika login gagal, kembalikan dengan pesan error
        return back()->withErrors([
            'email' => 'Kredensial yang Anda masukkan tidak cocok dengan catatan kami.',
        ]);
    }

    // Logout pengguna
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
