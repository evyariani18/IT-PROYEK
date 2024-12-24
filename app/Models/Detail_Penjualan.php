<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Penjualan extends Model
{

    use HasFactory;

    protected $table = 'detail_penjualan';
    protected $primaryKey = 'id_detailjual';
    public $incrementing = false;
    
    protected $fillable = [
        'id_penjualan', 
        'id_barang', 
        'jumlah', 
        'harga_satuan',
        'sub_total'];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan', 'id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang','id_barang');
    }
}

