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
        $data['ledger'] = Ledger::where('is_active',1)->where('unit_persediaan','!=',0)->get();
        $data['transaksi'] = Transaksi::all();
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
                'keterangan' => 'Persediaan awal',
                'id_transaksi' => $lastTransaksi->id,
                'unit_persediaan' => $request->input('tpp_unit'),
                'harga_satuan_persediaan' => $request->input('tpp_harga'),
                'total_harga_persediaan' => $request->input('tpp_total_harga'),
                'id_product' => $request->input('tpp_id_product'),
            ]);    
        }else if($lastTransaksi != null && $lastTransaksi->nama_transaksi == 'pembelian'){
            Ledger::create([
                'keterangan' => 'Pembelian',
                'id_transaksi' => $lastTransaksi->id,
                'unit_penambahan' => $request->input('tpp_unit'),
                'harga_satuan_penambahan' => $request->input('tpp_harga'),
                'total_harga_penambahan' => $request->input('tpp_total_harga'),
                'unit_persediaan' => $request->input('tpp_unit'),
                'harga_satuan_persediaan' => $request->input('tpp_harga'),
                'total_harga_persediaan' => $request->input('tpp_total_harga'),
                'id_product' => $request->input('tpp_id_product'),
            ]);    
        }
        $lastledger = Ledger::orderBy('created_at', 'DESC')->first();
        $lastTransaksi->update(['id_ledger' => $lastledger->id]);
        alert()->success('Berhasil','Woohoo, Data Berhasil Ditambah :D');
        return redirect()->route('transaksi.index');
    }

    public function createPenjualan(Request $request){
        $validation = $request->validate([
            'tp_nama_transaksi' => 'required',
            'tp_id_ledger' => 'required',
            'tp_harga' => 'required',
            'tp_unit' => 'required',
            'tp_total_harga' => 'required',
            'tp_id_product' => 'required'
        ]);
        Transaksi::create([
            'nama_transaksi' => $request->input('tp_nama_transaksi'),
            'id_ledger' => $request->input('tp_id_ledger'),
            'harga' => $request->input('tp_harga'),
            'unit' => $request->input('tp_unit'),
            'total_harga' => $request->input('tp_total_harga'),
            'id_product' => $request->input('tp_id_product'),
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
                'keterangan' => 'Penjualan',
                'unit_pengurangan' => $validation['tp_unit'],
                'harga_satuan_pengurangan' => $validation['tp_harga'],
                'total_harga_pengurangan' => $validation['tp_total_harga'],
                'persediaan' => 'persediaan',
                'unit_persediaan' => $unitPersediaanNew,
                'harga_satuan_persediaan' => $validation['tp_harga'],
                'total_harga_persediaan' => $totalHargaNew,
                'id_product' => $validation['tp_id_product'],
            ]);    
        }
        Ledger::findOrFail($validation['tp_id_ledger'])->update([
            'is_active' => '0'
        ]);
        return redirect()->route('transaksi.index');
        alert()->success('Berhasil','Woohoo, Data Berhasil Ditambah :D');
    }
    
    public function edit(){

    }
    
    public function delete($id){
        Transaksi::findOrFail($id)->delete();
        return redirect()->route('transaksi.index');
        alert()->success('Berhasil','Woohoo, Data Berhasil Dihapus :D');
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
