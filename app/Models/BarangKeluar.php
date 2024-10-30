<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar'; // Pastikan nama tabel sesuai
    protected $primaryKey = 'id_keluar'; // Set primary key
    public $incrementing = false; // Gunakan ini jika id bukan integer
    protected $keyType = 'string'; // Tipe id_keluar, sesuaikan jika perlu

    protected $fillable = [
        'id_keluar',
        'id_barang',
        'name',
        'jumlah',
        'harga_satuan',
        'harga_total',
        'tanggal_keluar',
        'keterangan',
    ];

    // Definisikan relasi dengan model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang'); // Relasi ke model Barang
    }
}
