<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'login'; // Sesuai nama tabel di database

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'id_user',       // ID pengguna yang login
        'ip_address',    // Alamat IP saat login
        'user_agent',    // Informasi perangkat/browser
        'login_at',      // Waktu login
        'logout_at',     // Waktu logout
    ];

    // Kolom yang disembunyikan saat model diubah ke array/JSON
    protected $hidden = [
        'user_agent',
    ];

    // Kolom bertipe datetime
    protected $dates = [
        'login_at',
        'logout_at',
    ];

    // Relasi ke tabel `users` (Many-to-One)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
