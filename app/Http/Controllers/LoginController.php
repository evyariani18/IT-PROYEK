<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('pengguna.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email', // Tambahkan validasi email
            'password' => 'required',
        ]);

        // Data untuk autentikasi
        $data = [
            'email' => $request->email,  // Ambil data email dari request
            'password' => $request->password  // Ambil data password dari request
        ];

        // Proses autentikasi
        if (Auth::attempt($data)) {
            if(Auth::user()->role == 'admin'){
             return redirect()->route('dashboard');   
            }else{
             return redirect()->route('dashboard2');
            }
              // Redirect ke dashboard jika berhasil login
        } else {
            return redirect()->route('login')->with('failed', 'Email atau password salah');
        }
    }

    public function logout(Request $request)
    {
        // Logout pengguna
        Auth::logout();

        // Redirect ke halaman login
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
    

    public function register_tampilan(){
        return view('pengguna.register');
    }

    public function register(Request $request)
    {
        // Validasi input form registrasi
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',  // Pastikan email unik
            'password' => 'required|string|min:8|confirmed',  // Pastikan password dan konfirmasinya cocok
        ]);

        // Jika validasi gagal, kembali ke form dengan pesan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Membuat pengguna baru dan menyimpannya ke database
        $user = new User();  // Pastikan ini menggunakan model User yang benar
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);  // Hash password sebelum disimpan
        $user->role = 'admin';  // Menetapkan nilai default role sebagai 'admin'
        $user->save();

        // Redirect ke halaman login setelah registrasi berhasil
        return redirect()->route('pengguna.login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }
    

}
