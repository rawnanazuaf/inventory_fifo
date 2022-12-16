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
        'keterangan',
        'unit_penambahan',
        'harga_satuan_penambahan',
        'total_harga_penambahan',
        'unit_pengurangan',
        'harga_satuan_pengurangan',
        'total_harga_pengurangan',
        'unit_persediaan',
        'harga_satuan_persediaan',
        'total_harga_persediaan',
        'is_active',
        'id_product',
    ];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function universitas(){
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }
}
