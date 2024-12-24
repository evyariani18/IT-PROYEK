<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = User::paginate(10); // Menggunakan paginasi
        return view('users.index', compact('users'));
    }

    // Menampilkan form registrasi
    public function showRegisterForm()
    {
        return view('users.register'); // Pastikan Anda membuat view register.blade.php
    }

    // Proses registrasi pengguna baru
    public function register(Request $request)
    {
        // Validasi input registrasi
        $incomingFields = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'username' => ['required', 'string', 'min:3', 'max:20', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:20'],
        ]);

        // Generate nilai untuk id_user
        $lastUser = User::orderBy('id_user', 'desc')->first();
        $newIdUser = $lastUser ? 'U' . str_pad((intval(substr($lastUser->id_user, 1)) + 1), 3, '0', STR_PAD_LEFT) : 'U001';

        // Enkripsi password
        $incomingFields['password'] = bcrypt($incomingFields['password']);

        // Tambahkan id_user dan level ke dalam data yang akan disimpan
        $incomingFields['id_user'] = $newIdUser;
        $incomingFields['level'] = 1;  // Misalnya, set level default adalah '1'

        // Simpan pengguna baru ke database
        $user = User::create($incomingFields);

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Redirect ke halaman login setelah registrasi
        return redirect()->route('login'); // Mengarahkan pengguna ke halaman login
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('users.login'); // Pastikan Anda membuat view login.blade.php
    }

    // Proses login pengguna
    public function login(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Cek kredensial
        if (Auth::attempt($credentials)) {
            // Login berhasil, redirect ke halaman utama atau halaman yang sebelumnya diakses
            return redirect()->intended('/dashboard'); // Mengarahkan ke dashboard setelah login
        }

        // Jika gagal login, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Logout pengguna
    public function logout()
    {
        // Melakukan logout
        Auth::logout();
        
        // Redirect ke halaman login
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }

    // Menampilkan form tambah pengguna (admin)
    public function create()
    {
        return view('users.create'); // Pastikan view create ada
    }

    // Menyimpan pengguna baru (admin)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'level' => 'required|in:1,2,3',
        ]);

        $lastUser = User::orderBy('id_user', 'desc')->first();
        $newIdUser = $lastUser ? 'U' . str_pad((intval(substr($lastUser->id_user, 1)) + 1), 3, '0', STR_PAD_LEFT) : 'U001';

        User::create([
            'id_user' => $newIdUser,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => $request->level,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    // Menampilkan form edit pengguna
    public function edit(User $user)
    {
        return view('users.edit', compact('user')); // Pastikan view edit ada
    }

    // Mengupdate data pengguna
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id_user . ',id_user',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id_user . ',id_user',
            'password' => 'nullable|string|min:8',
            'level' => 'required|in:1,2,3',
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
            'level' => $request->level,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diubah.');
    }

    // Menghapus pengguna
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }

    public function adminDahsboard(){
        return view('dashboard.admin');
    }

    public function karyawanDashboard(){
        return view('dashboard.karyawan');
    }
}
