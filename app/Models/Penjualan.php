<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{

    use HasFactory;

    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';
    public $incrementing = false;
    protected $fillable = [
        'id_penjualan',
        'tanggal_penjualan',
        'total_harga',
        'keterangan'
    ];

    public function details(){
        return $this->hasMany(Detail_Penjualan::class, 'id_penjualan', 'id_penjualan');
    }
}
