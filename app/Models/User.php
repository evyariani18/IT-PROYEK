<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nama tabel yang digunakan di database
    protected $table = 'users';

    // Primary key untuk tabel ini
    protected $primaryKey = 'id_user';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',   // Menambahkan kolom role
    ];

    // Kolom yang disembunyikan (seperti password)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casting tipe data kolom
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
