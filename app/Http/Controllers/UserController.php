<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10); // Menggunakan paginasi untuk daftar pengguna
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create'); // Menampilkan form pembuatan pengguna baru
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'level' => 'required|integer', // Validasi level
        ]);

        $lastUser = User::OrderBy('id_user', 'desc')->first();
        $newIdUser = $lastUser ? 'U' . str_pad((intval(substr($lastUser->id_user, 1)) + 1), 3, '0', STR_PAD_LEFT) : 'U001';

        // Buat pengguna baru
        User::create([
            'id_user' => $newIdUser,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'level' => $request->level, // Simpan level dari input form
            'password' => bcrypt($request->password), // Enkripsi password
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user')); // Menampilkan form edit pengguna
    }

    public function update(Request $request, User $user)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8', // Password opsional saat update
            'level' => 'required|integer', // Validasi level
        ]);

        // Update data pengguna
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'level' => $request->level, // Update level
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password, // Hanya update password jika diisi
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diubah.');
    }

    public function destroy(User $user)
    {
        $user->delete(); // Hapus pengguna
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
