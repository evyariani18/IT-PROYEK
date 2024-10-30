<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'transaksi';

    protected $fillable = [
        'id_transaksi',
        'id_user',
        'id_barang',
        'jumlah',
        'harga_satuan',
        'harga_total',
        'tanggal_transaksi',
        'keterangan',
    ];

    // Definisikan relasi barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    // Definisikan relasi jika ada
    public function barangmasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'id_transaksi', 'id_transaksi');
    }

    public function barangkeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'id_transaksi', 'id_transaksi');
    }

    // Jika Anda ingin menambahkan relasi dengan pengguna
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
