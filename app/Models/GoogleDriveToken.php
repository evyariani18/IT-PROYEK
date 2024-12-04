<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleDriveToken extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika nama tabel tidak mengikuti konvensi plural
    protected $table = 'google_drive_tokens';  // Pastikan tabel ini ada di database Anda

    // Menentukan kolom yang dapat diisi (fillable)
    protected $fillable = [
        'access_token', 
        'refresh_token', 
        'expires_in', 
        'token_type'
    ];

    // Jika tabel tidak memiliki kolom created_at dan updated_at, set timestamps ke false
    public $timestamps = false;
}
