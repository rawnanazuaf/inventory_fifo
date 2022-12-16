<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'nama_product' => 'TV CHOCOLATOS 14 Inc',
            'harga' => 1240000,
            'is_active' => 1,
        ]);
        Product::create([
            'nama_product' => 'TV SUMSANG 14 Inc',
            'harga' => 2240000,
            'is_active' => 1,
        ]);
        Product::create([
            'nama_product' => 'TV LG 14 Inc',
            'harga' => 3222000,
            'is_active' => 1,
        ]);
    }
}
