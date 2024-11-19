<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

<<<<<<< HEAD
    // Nama tabel yang digunakan oleh model ini
    protected $table = 'logins';

    // Kolom yang bisa diisi melalui mass assignment
    protected $fillable = [
        'username',
        'password',
        'last_login_at',
    ];

    // Menyembunyikan kolom tertentu dari array atau JSON
    protected $hidden = [
        'password',
    ];

    // Menentukan kolom dengan tipe datetime
    protected $dates = [
        'last_login_at',
    ];

    // Contoh relasi one-to-one, jika login berhubungan dengan tabel user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

=======
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', // ID pengguna yang login
        'login_at', // Waktu login
    ];

    /**
     * Get the user that owns the login.
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Relasi dengan model User
    }
}
>>>>>>> katalog
