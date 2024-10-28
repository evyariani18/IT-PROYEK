<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

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
