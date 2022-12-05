<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;
    protected $table = 'ledger';
    protected $fillable = [
        'id_transaksi',
        'penambahan',
        'unit_penambahan',
        'harga_satuan_penambahan',
        'total_harga_penambahan',
        'pengurangan',
        'unit_pengurangan',
        'harga_satuan_pengurangan',
        'total_harga_pengurangan',
        'persediaan',
        'unit_persediaan',
        'harga_satuan_persediaan',
        'total_harga_persediaan',
        'is_active',
    ];

    public function scopeActive($query){
        return $query->where('active', 1);
    }
}
