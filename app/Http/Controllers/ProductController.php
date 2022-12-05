<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $data['product'] = Product::all();
        return view('product.index', $data);
    }

    public function create(Request $request){
        $validation = $request->validate([
            'nama_product' => 'required',
            'harga' => 'required'
        ]);
        Product::create($validation);
        alert()->success('Berhasil','Woohoo, Data Berhasil Ditambah :D');
        return redirect()->route('product.index');
    }

    public function edit(Request $request, $id){
        $product = Product::find($id);
        $product->nama_product                      = $request->input("md_nama_product");
        $product->harga                       = $request->input("md_harga");     
        $product->save(); 
        alert()->success('Berhasil','Woohoo, Data Berhasil Diubah :D');
        return redirect()->route('product.index');
    }

    public function delete($id){
        $product = Product::find($id)->update(['is_active'=>'0']);
        return redirect('/application');
    }

}
