<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs'; // Nama tabel di database
    protected $primaryKey = 'id_barang'; // Primary key
    public $incrementing = false; // Jika primary key tidak auto increment
    protected $keyType = 'string'; // Jenis data primary key (jika 'string', jika tidak bisa dihilangkan)

    protected $fillable = [
        'id_barang', 
        'name', 
        'stok', 
        'harga', 
        'deskripsi', 
        'image', 
        'id_merek', 
        'id_kategori'
    ];

    // Definisi relasi ke model Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_merek', 'id_merek');
    }

    // Definisi relasi ke model Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id_kategori');
    }

    // Definisi relasi ke model BarangKeluar (jika ada)
    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'id_barang', 'id_barang');
    }
}
