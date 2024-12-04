<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nama tabel di database
    protected $table = 'users';

    // Primary key dan tipe data
    protected $primaryKey = 'id_user';
    public $incrementing = false; // Primary key bukan auto increment
    protected $keyType = 'string'; // Tipe data primary key

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_user',   // ID unik pengguna
        'name',      // Nama pengguna
        'username',  // Username
        'email',     // Email pengguna
        'password',  // Password
        'level',     // Level akses
    ];

    // Kolom yang disembunyikan
    protected $hidden = [
        'password',        // Sembunyikan password
        'remember_token',  // Sembunyikan token "remember me"
    ];

    // Casting tipe data kolom
    protected $casts = [
        'email_verified_at' => 'datetime', // Kolom waktu jika ada
    ];
}
