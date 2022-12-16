<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'nama_transaksi',
        'id_product',
        'id_ledger',
        'unit',
        'harga',
        'total_harga',
        'is_active',
    ];

    public function scopeActive($query){
        return $query->where('is_active', 1);
    }

    public function product(){
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function ledger()
    {
        return $this->hasOne(Ledger::class, 'id_transaksi', 'id');
    }
}
