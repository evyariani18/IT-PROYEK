<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard2 extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan default "dashboards"
    protected $table = 'dashboard2';

    // Tentukan primary key jika tidak menggunakan 'id'
    protected $primaryKey = 'id_dashboard';

    // Nonaktifkan timestamps jika tabel tidak memiliki kolom created_at dan updated_at
    public $timestamps = false;

    // Daftar kolom yang bisa diisi secara massal
    protected $fillable = [
        'name', 'category_id', 'brand_id', 'stock', 'price'
    ];
}
