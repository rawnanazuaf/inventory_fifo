<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(){
        $data['product'] = Product::all();
        $data['ledger'] = Ledger::all();
        $data['transaksi'] = DB::table('transaksi')
                            ->join('product', 'product.id','=','transaksi.id_product')
                            ->where('transaksi.is_active',1)
                            ->where('product.is_active',1)
                            ->get();
        return view('transaksi.index', $data);
    }
    
    public function createPembelianPersediaan(Request $request){
        $validation = $request->validate([
            'tpp_nama_transaksi' => 'required',
            'tpp_id_product' => 'required',
            'tpp_harga' => 'required',
            'tpp_unit' => 'required',
            'tpp_total_harga' => 'required',
        ]);
        Transaksi::create([
            'nama_transaksi' => $request->input('tpp_nama_transaksi'),
            'id_product' => $request->input('tpp_id_product'),
            'harga' => $request->input('tpp_harga'),
            'unit' => $request->input('tpp_unit'),
            'total_harga' => $request->input('tpp_total_harga'),
        ]);
        $lastTransaksi = Transaksi::orderBy('created_at', 'DESC')->first();
        if ($lastTransaksi != null && $lastTransaksi->nama_transaksi == 'persediaan_awal') {
            Ledger::create([
                'id_transaksi' => $lastTransaksi->id,
                'persediaan' => 'persediaan',
                'unit_persediaan' => $request->input('tpp_unit'),
                'harga_satuan_persediaan' => $request->input('tpp_harga'),
                'total_harga_persediaan' => $request->input('tpp_total_harga'),
            ]);    
        }else if($lastTransaksi != null && $lastTransaksi->nama_transaksi == 'pembelian'){
            Ledger::create([
                'id_transaksi' => $lastTransaksi->id,
                'penambahan' => 'penambahan',
                'unit_penambahan' => $request->input('tpp_unit'),
                'harga_satuan_penambahan' => $request->input('tpp_harga'),
                'total_harga_penambahan' => $request->input('tpp_total_harga'),
                'persediaan' => 'persediaan',
                'unit_persediaan' => $request->input('tpp_unit'),
                'harga_satuan_persediaan' => $request->input('tpp_harga'),
                'total_harga_persediaan' => $request->input('tpp_total_harga'),
            ]);    
        }
        
        alert()->success('Berhasil','Woohoo, Data Berhasil Ditambah :D');
        return redirect()->route('transaksi.index');
    }

    public function createPenjualan(Request $request){
        $validation = $request->validate([
            'tp_nama_transaksi' => 'required',
            'tp_id_ledger' => 'required',
            'tp_harga' => 'required',
            'tp_unit' => 'required',
            'tp_total_harga' => 'required'
        ]);
        Transaksi::create([
            'nama_transaksi' => $request->input('tp_nama_transaksi'),
            'id_ledger' => $request->input('tp_id_ledger'),
            'harga' => $request->input('tp_harga'),
            'unit' => $request->input('tp_unit'),
            'total_harga' => $request->input('tp_total_harga'),
        ]);
        $lastTransaksi = Transaksi::orderBy('created_at', 'DESC')->first();
        $ledgerUpdate = Ledger::findOrFail($validation['tp_id_ledger']);
        
        $unitPersediaanRequest = $validation['tp_unit'];
        $unitPersediaanNew = (($ledgerUpdate->unit_persediaan)-($unitPersediaanRequest));
        
        $totalHargaRequest = $validation['tp_total_harga'];
        $totalHargaNew = (($ledgerUpdate->total_harga_persediaan)-($totalHargaRequest));
        if ($lastTransaksi != null && $lastTransaksi->nama_transaksi == 'penjualan') {
            Ledger::create([
                'id_transaksi' => $lastTransaksi->id,
                'pengurangan' => 'pengurangan',
                'unit_pengurangan' => $validation['tp_unit'],
                'harga_satuan_pengurangan' => $validation['tp_harga'],
                'total_harga_pengurangan' => $validation['tp_total_harga'],
                'persediaan' => 'persediaan',
                'unit_persediaan' => $unitPersediaanNew,
                'harga_satuan_persediaan' => $validation['tp_harga'],
                'total_harga_persediaan' => $totalHargaNew
            ]);    
        }
        Ledger::findOrFail($validation['tp_id_ledger'])->update([
            'unit_persediaan' => null,
            'harga_satuan_persediaan' => null,
            'total_harga_persediaan' => null
        ]);
        alert()->success('Berhasil','Woohoo, Data Berhasil Ditambah :D');
        return redirect()->route('transaksi.index');
    }
    
    public function edit(){

    }
    
    public function delete(){

    }

    public function getProductDetail($id){
        $produk = Product::findOrFail($id);
        return response()->json($produk);
    }
    
    public function getLedgerDetail($id){
        $ledger = Ledger::findOrFail($id);
        return response()->json($ledger);
    }
}
