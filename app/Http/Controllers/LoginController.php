<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('logins.index'); // Ganti dengan nama view sesuai dengan folder dan file yang kamu buat
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Autentikasi pengguna
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika berhasil, redirect ke halaman yang diinginkan
            return redirect()->intended('dashboard'); // Ganti dengan route yang sesuai
        }

        // Jika gagal, kembalikan ke form login dengan pesan error
        return redirect()->back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    // Proses logout
    public function logout()
    {
        Auth::logout(); // Mengeluarkan pengguna
        return redirect('/login'); // Redirect ke halaman utama atau halaman login
    }
}
