<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang'; // Nama tabel di database
    protected $primaryKey = 'id_barang'; // Primary key
    public $incrementing = false; // Jika primary key tidak auto increment
    protected $keyType = 'string'; // Jenis data primary key (jika 'string', jika tidak bisa dihilangkan)

    protected $fillable = [
        'id_barang', 
        'kode_barang',
        'name', 
        'stok', 
        'harga', 
        'deskripsi', 
        'image', 
        'id_merek', 
        'id_kategori'
    ];

    // Definisi relasi foreign key ke model Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_merek', 'id_merek');
    }

    // Definisi relasi foreign key ke model Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id_kategori');
    }
}
