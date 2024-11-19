<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Katalog extends Model
{
    use HasFactory;

    // Nama tabel jika berbeda dari bentuk jamak model
    protected $table = 'katalog';

    // Kolom yang bisa diisi secara massal
    protected $fillable = ['nama', 'deskripsi', 'harga', 'stok'];

    // Menentukan primary key (jika tidak menggunakan 'id')
    protected $primaryKey = 'id_katalog';

    // Menonaktifkan timestamps jika tabel tidak memiliki kolom 'created_at' dan 'updated_at'
    public $timestamps = false;
}
