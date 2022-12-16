<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'nama_product',
        'harga',
        'is_active'
    ];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_product', 'id');
    }
    
    public function ledger()
    {
        return $this->hasMany(Ledger::class, 'id_product', 'id');
    }
}
